<?php

namespace App\Http\Controllers;

use App\Models\{
    Property, Account, Administrator, AdminManageOwner, Owner, Tenant, Payment
};
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function adminInterface()
    {
        $owners = Owner::all();
        $properties = Property::all();
        $tenants = Tenant::with('account')->get();
        return view('admin.adminInterface',compact('owners', 'properties','tenants'));
    }
    function adminVerification()
    {
        $properties = Property::all();
        $owners = Owner::all();
        $files = Storage::files('public/documents');

    // Extract only the file names from the paths
    $documentPaths = array_map('basename', $files);
        return view('admin.adminVerification', compact('owners', 'properties', 'documentPaths'));
    }
    function propertyVerification()
    {
        $properties = Property::all();

        return view('admin.propertyVerification', compact('properties'));
    }

    function adminManagement()
    {
        $owners = Owner::all();
        $tenants = Tenant::all();
        return view('admin.adminManagement', compact('owners','tenants'));
    }
    function adminManageProperty()
    {
        $properties = Property::with('description')->get();
        return view('admin.adminManageProperty', compact('properties'));
    }
    public function adminManageTenant()
    {
        // Retrieve all tenants with their associated accounts
        $tenants = Tenant::with('account')->get();

        return view('admin.adminManageTenant', compact('tenants'));
    }
    public function adminManageLandlord()
    {
        // Retrieve all tenants with their associated accounts
        $owners = Owner::with('account')->get();

        return view('admin.adminManageLandlord', compact('owners'));
    }


    public function verifylandlord($id)
    {
        $accounts_id = auth()->id();
        $owner = Owner::findOrFail($id);

        $administrator = Administrator::where('account_id', $accounts_id)->first();

        if ($administrator) {
            $owner->verification_status = 'verified';
            $owner->save();

            $owner->administrators()->attach($administrator->id, ['created_at' => now(), 'updated_at' => now()]);

            return redirect()->back()->with('success', 'Landlord verification status updated successfully');
        } else {
            // Handle the case where the administrator is not found
            return redirect()->back()->with('error', 'Administrator not found.');
        }


    }


    public function verifyproperty($id)
    {
        $accounts_id = auth()->id();
        $properties = Property::findOrFail($id);

        $administrator = Administrator::where('account_id', $accounts_id)->first();

        if ($administrator) {
            if ($properties->verification_status !== 'verified') {
                $properties->update(['verification_status' => 'verified']);

                $properties->administrators()->attach($administrator->id, ['created_at' => now(), 'updated_at' => now()]);

                return redirect()->back()->with('success', 'Property verification status updated successfully');
            } else {
                return redirect()->back()->with('info', 'Property is already verified.');
            }
        } else {
            return redirect()->back()->with('error', 'Administrator not found.');
        }
    }

    public function destroyOwner(Owner $ownerDelete)
{
    // Delete associated account details
    if ($ownerDelete->account) {
        $ownerDelete->account->delete();
    }

    // Delete the owner
    $ownerDelete->delete();

    return redirect()->back()->with('success', 'Owner deleted successfully!');
}

public function destroyTenant(Tenant $tenantDelete)
{
    // Delete associated account details
    if ($tenantDelete->account) {
        $tenantDelete->account->delete();
    }

    // Delete the tenant
    $tenantDelete->delete();

    return redirect()->back()->with('success', 'Tenant deleted successfully!');
}

public function destroyProperty(Property $propertyDelete)
{
    // Delete the property and its associated relationships
    $propertyDelete->delete();

    return redirect()->back()->with('success', 'Property deleted successfully!');
}
 // Function to create a ZIP file
 public function createZip($owner)
{
    // Retrieve all document paths associated with the owner
    $documentPaths = explode(',', $owner->file_path);

    // Create a temporary directory to store the documents
    $tempDir = sys_get_temp_dir() . '/' . uniqid('documents_');
    mkdir($tempDir);

    // Copy all the documents to the temporary directory
    foreach ($documentPaths as $documentPath) {
        $sourcePath = storage_path('app/public/documents/' . trim($documentPath));
        $destinationPath = $tempDir . '/' . basename($documentPath);
        copy($sourcePath, $destinationPath);
    }

    // Create a ZIP file containing all the documents
    $zipFilePath = sys_get_temp_dir() . '/' . uniqid('documents_') . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
        foreach ($documentPaths as $documentPath) {
            $zip->addFile($tempDir . '/' . basename($documentPath), basename($documentPath));
        }
        $zip->close();
    }

    // Provide a download link for the ZIP file
    return $zipFilePath;
}



// Controller method to handle the download
public function downloadAllDocuments($ownerId)
{
    $owner = Owner::findOrFail($ownerId);
    $zipFilePath = $this->createZip($owner);
    return response()->download($zipFilePath)->deleteFileAfterSend(true);
}

public function download($documentPath)
{
    $filePath = public_path('documents/' . $documentPath);

    if (File::exists($filePath)) {
        // Return the file as a download response
        return Response::download($filePath)->deleteFileAfterSend();
    } else {
        return back()->with('error', 'File not found.');
    }
}

public function dashboard()
{
    // Count the number of tenants
    $totalTenants = Tenant::count();

    // Count the number of owners
    $totalOwners = Owner::count();

    // Calculate the total amount of payments
    $totalPayments = Payment::sum('amount');

    // Count the number of rented properties
    $totalRentedProperties = Property::whereHas('inquiries', function ($query) {
        $query->whereNotNull('tenant_id');
    })->count();

    return view('admin.adminDashboard', compact('totalTenants', 'totalOwners', 'totalPayments', 'totalRentedProperties'));

}
}
