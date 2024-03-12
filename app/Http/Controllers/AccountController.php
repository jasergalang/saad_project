<?php

namespace App\Http\Controllers;


use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Account;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function login()
    {
        return view('account.login');
    }
    function landlordregister()
    {
        return view('account.landlordregister');
    }
    function tenantregister()
    {
        return view('account.tenantregister');
    }
    function adminregister()
    {
        return view('account.adminregister');
    }
    public function aboutus()
    {
        return view('account.aboutus');
    }
    function user()
    {
        return view('account.user');
    }
    public function __construct()
    {
        $this->middleware('web');
    }
    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:15',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $account = Auth::user();
            $request->session()->regenerate();
            switch ($account->roles) {
                case 'owner':
                    $owner = Owner::where('account_id', $account->id)->first();
                    if ($owner) {
                        return redirect()->route('user')->with('ownerID', $owner->id);
                    }
                    break;
                case 'tenant':
                    $tenant = Tenant::where('account_id', $account->id)->first();
                    if ($tenant) {
                        return redirect()->route('index')->with('tenantID', $tenant->id);
                    }
                    break;
                case 'admin':
                    $administrator = Administrator::where('account_id', $account->id)->first();
                    if ($administrator) {
                        return redirect()->route('adminManagement')->with('administratorID', $administrator->id);
                    }
                    break;
                default:
                    return back()->withInput()->withErrors(['email' => 'Invalid user role.']);
            }
            return back()->withInput()->withErrors(['email' => 'Invalid user role.']);
        }

        return back()->withInput()->withErrors(['email' => 'Invalid email or password.']);
    }
    function llregister(Request $request)
    {
        $this->validateRegistration($request, 'owner');

        $data = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'roles' => 'owner',
        ];

        $account = Account::create($data);

        if (!$account) {
            return redirect(route('llregister'))->with("fail", "Registration Failed!! Please Try Again.");
        }

        $ownerData = [
            'account_id' => $account->id,
            'facebook_link' => $request->facebook_link,
        ];

        $owner = new Owner($ownerData);

        if ($request->hasFile('uploaded_files')) {
            $filePaths = [];

            foreach ($request->file('uploaded_files') as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('documents', $fileName, 'public');
                $filePaths[] = $fileName;
            }
            $owner->file_path = implode(',', $filePaths);
        }

        $account->owner()->save($owner);

        return redirect(route('login'))->with("success", "Registration Successful!!");

    }
    function ttregister(Request $request)
    {
        $this->validateRegistration($request, 'tenant');

        $account = Account::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'roles' => 'tenant',
        ]);
        if (!$account) {
            return redirect(route('ttregister'))->with("fail", "Registration Failed!! Please Try Again.");
        }
        $tenant = new Tenant();
        $tenant->account_id = $account->id;
        $tenant->save();

        return redirect(route('login'))->with("success", "Registration Successful!!");
    }
    function adregister(Request $request)
    {
        $this->validateRegistration($request, 'administrator');

        $data = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'roles' => 'admin',
        ];

        $account = Account::create($data);

        if (!$account) {
            return redirect(route('adregister'))->with("fail", "Registration Failed!! Please Try Again.");
        }

        $administrator = new Administrator(['account_id' => $account->id]);
        $administrator->save();

        return redirect(route('login'))->with("success", "Registration Successful!!");
    }
    private function validateRegistration(Request $request, $roles)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => "required|email|unique:accounts,email,NULL,id,roles,$roles",
            'contact' => 'required|numeric|digits:11',
            'password' => 'required|min:8|max:15|confirmed',
        ]);
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
    public function users()
    {
        $accountId = auth()->id();

        // Retrieve owners with all properties (including soft-deleted)
        $owners = Owner::with(['properties' => function ($query) {
            $query->withTrashed(); // Include soft-deleted properties
        }])
        ->where('account_id', $accountId)
        ->get();

        // Flatten the properties
        $properties = $owners->flatMap(function ($owner) {
            return $owner->properties;
        })->all();

        return view('account.user', compact('properties'));
    }
    public function showChat(Property $property)
    {
        $user = auth()->user();
        $messages = Message::where('property_id', $property->id)
                          ->with('fromUser')
                          ->orderBy('created_at')
                          ->get();

        return view('tenant.chat', compact('property', 'messages', 'user'));
    }


    public function sendMessage(Request $request)
    {
        // Validate the form data
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'content' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Determine the sender and receiver based on the user role
        $senderId = $user->id;
        $property = Property::find($request->input('property_id'));

        if ($user->roles == 'tenant') {
            // Tenant is the sender, owner is the receiver
            $receiverId = $property->owner->account->id;
        } elseif ($user->roles == 'owner') {
            // Owner is the sender, find the tenant who initiated the conversation
            $receiverId = $property->inquiries()->first()->tenant->account->id;
        } else {
            // Handle other user roles or unauthorized access
            abort(403, 'Unauthorized access to send message.');
        }

        $message = new Message([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'property_id' => $request->input('property_id'),
            'content' => $request->input('content'),
        ]);

        $message->save();

        return redirect()->back()->with('success', 'Property restored successfully.');
    }


    protected function getLatestMessages($propertyId)
    {
        // Retrieve the latest messages for the given property ID using Eloquent
        $latestMessages = Message::where('property_id', $propertyId)
            ->take(10) // Assuming you want to retrieve the latest 10 messages, adjust as needed
            ->get();

        // Optionally, you can eager load the sender information for each message
        $latestMessages->load('fromUser');

        return $latestMessages;
    }

    public function restore($id )
    {
        $property=Property::withTrashed()->where('id', $id)->first();
        $property->restore();
        return redirect()->back()->with('success', 'Property restored successfully.');
    }

}
