<?php

namespace App\Http\Controllers;


use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Account;
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
        $this->middleware('web'); // Apply 'web' middleware to all methods in this controller
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
                    $owner = Owner::where('accounts_id', $account->id)->first();
                    if ($owner) {
                        return redirect()->route('user')->with('ownerID', $owner->id);
                    }
                    break;
                case 'tenant':
                    $tenant = Tenant::where('accounts_id', $account->id)->first();
                    if ($tenant) {
                        return redirect()->route('index')->with('tenantID', $tenant->id);
                    }
                    break;
                case 'admin':
                    $administrator = Administrator::where('accounts_id', $account->id)->first();
                    if ($administrator) {
                        return redirect()->route('adminInterface')->with('administratorID', $administrator->id);
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
            'accounts_id' => $account->id,
            'facebook_link' => $request->facebook_link,
        ];
        $owner = new Owner($ownerData);
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
        $tenant->accounts_id = $account->id;
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

        $administrator = new Administrator(['accounts_id' => $account->id]);
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
        $accounts_id = auth()->id();
        $owners = Owner::where('accounts_id', $accounts_id)->get();

        $properties = $owners->flatMap(function ($owner) {
            return $owner->properties;
        })->all();

        return view('account.user', compact('properties'));
    }

}
