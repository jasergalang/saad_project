<?php

namespace App\Http\Controllers;

use App\Models\{
    Tenant, Inquiry, Property, Owner, Contract, Account, Payment
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class ContractController extends Controller
{
    public function tenantcontract()
    {
        $inquiries_id = session('id');
        $propertyTitle = session('propertyTitle');
        $tenantDetails = session('tenantDetails');
        $inquiry = session('inquiry');
        $propertyAddress = session('propertyAddress');


        return view('tenant.tenantcontract', compact('propertyTitle', 'tenantDetails', 'inquiry', 'inquiries_id', 'propertyAddress'));
    }
    //In viewproperty
    public function inquire(Request $request)
    {
        $accountId = auth()->user()->id;

        if (!$request->has('property_id') || !Property::where('id', $request->input('property_id'))->exists()) {
            return redirect()->back()->with('error', 'Invalid or missing property_id')->withInput();
        }

        $property = Property::findOrFail($request->property_id);

        if ($property->owner->id == $accountId) {
            return redirect()->back()->with('error', 'You cannot inquire about your own property!');
        }
        $tenant = Tenant::where('account_id', $accountId)->first();
        Inquiry::create([
            'tenant_id' => $tenant->id,
            'owner_id' => $property->owner->id,
            'property_id' => $property->id,
        ]);

        return redirect()->back()->with('success', 'Inquiry submitted successfully!');
    }
    //in inquiriesform
    public function inquiriesform()
    {   $accountId = auth()->user()->id;

        $owner = Owner::with('account')->where('account_id', $accountId)->first();
        if (!$owner) {
            return redirect()->route('home')->with('error', 'Owner not found.');
        }

        $ownerId = $owner->id;
        $inquiries = Inquiry::where('owner_id', $ownerId)
            ->with(['tenant.account', 'property.description'])
            ->get();

        return view('tenant.inquiriesform', compact('inquiries'));
    }

    public function acceptInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $authenticatedUserId = auth()->user()->id;

        $owner = Owner::where('account_id', $authenticatedUserId)->first();

        if (!$owner || $owner->id != $inquiry->property->owner->id) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $inquiry->update(['inquiry_status' => 'accepted']);
        $property = $inquiry->property;
        $tenant = $inquiry->tenant;

        $propertyTitle = $property->description->title;

        $tenantDetails = $tenant->account;
        $propertyAddress = $property->address;

        session([
            'inquiry' => $inquiry,
            'propertyTitle' => $propertyTitle,
            'tenantDetails' => $tenantDetails,
            'propertyAddress' => $propertyAddress,
            'id' => $id,
        ]);

        return redirect()->back()->with('success', 'Inquiry accepted successfully!');
    }
    public function rejectInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        // Retrieve authenticated user's ID
        $authenticatedUserId = auth()->user()->id;

        // Find the owner with the corresponding accounts_id
        $owner = Owner::where('account_id', $authenticatedUserId)->first();

        if (!$owner || $owner->id != $inquiry->property->owner->id) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $inquiry->update(['inquiry_status' => 'rejected']);

        return redirect()->back()->with('success', 'Inquiry rejected successfully!');

    }
    public function createContract(Request $request, $inquiry_id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $contractData = [
            'inquiry_id' => $inquiry_id,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        $contract = Contract::create($contractData);

        $uploadedFilePaths = [];

        // Handle file upload
        if ($request->hasFile('uploaded_files')) {
            foreach ($request->file('uploaded_files') as $uploadedFile) {
                $fileName = uniqid() . '_' . $uploadedFile->getClientOriginalName();
                $uploadedFile->storeAs('documents', $fileName, 'public'); // Make sure the 'documents' folder exists in your storage directory
                $uploadedFilePaths[] = $fileName;
            }

            // Update the contract with the file paths
            $contract->lease_agreement = json_encode($uploadedFilePaths); // Store file paths as JSON
            $contract->save();
        }
        session(['contract' => $contract]);

        return redirect()->back()->with('success', 'Contract created successfully');
    }




    public function paymentform()
    {
        $accountId = auth()->user()->id;
        $user = Account::with('tenant.inquiries.property.rate', 'tenant.inquiries.property.address', 'tenant.inquiries.contract.payment')->find($accountId);

        $inquiry = $user->tenant->inquiries->first();
        $contract = $inquiry ? $inquiry->contract : null;
        $property = $inquiry ? $inquiry->property : null;
        $paymentDate = null;

        if ($contract) {
            $payment = $contract->payment->first();
            if ($payment) {
                $paymentDate = $payment->payment_date;
            } else {
                $paymentDate = $contract->start_date;
            }
        }

        $totalAmount = $property ? $property->rate->weekly : null;

        return view('tenant.paymentform', compact('property', 'paymentDate', 'totalAmount', 'contract'));
    }

    public function submitPayment(Request $request)
    {
        $request->validate([
            'payment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $contract = Contract::find($request->input('contract_id'));
        if (!$contract) {
            return redirect()->back()->with('error', 'Invalid contract ID.');
        }
        $payment = new Payment([
            'payment_status' => 'paid',
            'payment_date' => $request->input('payment_date'),
        ]);
        $contract->payment()->save($payment);
        if ($request->hasFile('payment_image')) {
            $imageFile = $request->file('payment_image');
            $customFilename = 'payment_' . time() . '.' . $imageFile->getClientOriginalExtension();

            $imagePath = $imageFile->storeAs('images', $customFilename, 'public');

            $payment->payment_image = $imagePath;
            $payment->save();
        }
        return redirect()->back()->with('success', 'Payment submitted successfully!');
    }
    public function profile()
    {
        $accountId = auth()->user()->id;

        $tenant = Tenant::where('account_id', $accountId)->first();
        $accounts = Account::find($accountId);
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        $inquiries = $tenant->inquiries;

        $contracts = [];
        foreach ($inquiries as $inquiry) {
            $contracts[] = $inquiry->contract()->first(); // Directly retrieve the first contract
        }
        return view('tenant.profile', compact('tenant', 'accounts', 'contracts','inquiries'));
    }
    public function downloadContract($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        if (!$inquiry->contract) {
            return abort(404, 'No associated contract found for the specified ID.');
        }

        $filePath = $inquiry->contract->lease_agreement;

        // Generate a direct URL for the file
        $fileUrl = asset('/' . $filePath);

        // Make sure the file exists
        if (!file_exists(public_path('/' .$filePath))) {
            return abort(404, 'Contract file not found.');
        }

        // Set the appropriate headers for a download response
        $headers = [
            'Content-Type' => 'application/pdf', // Adjust this based on your file type
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ];

        return response()->download(public_path('/' . $filePath), basename($filePath), $headers);
    }
    public function uploadContract(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'contract_file' => 'required|mimes:pdf|max:2048',
        ]);

        $uploadedFile = $request->file('contract_file');

        $filePath = $uploadedFile->store('contract', 'public');

        $contract = $inquiry->contract ?? new Contract();
        $contract->lease_agreement = $filePath;
        $contract->save();

        return redirect()->back()->with('success', 'Contract uploaded successfully.');
    }
    public function manageContract()
    {
        $accountId = auth()->user()->id;

        // Retrieve the owner model associated with the authenticated account
        $owner = Owner::with('account')->where('account_id', $accountId)->first();

        if (!$owner) {
            return redirect()->route('home')->with('error', 'Owner not found.');
        }

        $ownerId = $owner->id;

        $inquiries = Inquiry::where('owner_id', $ownerId)
            ->with('property.rate', 'property.address', 'contract.payment')
            ->get();

        $contracts = [];

        foreach ($inquiries as $inquiry) {
            $contracts[] = $inquiry->contract;
        }

        return view('tenant.manageContract', compact('contracts','inquiries'));

    }


}
