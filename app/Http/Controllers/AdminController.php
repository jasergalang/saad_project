<?php

namespace App\Http\Controllers;

use App\Models\{
    Property, Account, Administrator, AdminManageOwner, Owner, Tenant
};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function adminInterface()
    {
        $owners = Owner::all();
        $properties = Property::all();
        $tenants = Tenant::with('account')->get();
        return view('admin.adminInterface',compact('owners', 'properties','tenants'));
    }
    function landlordVerification()
    {
        return view('admin.landlordVerification', compact('owners'));
    }
    function propertyVerification()
    {
        $properties = Property::all();

        return view('admin.propertyVerification', compact('properties'));
    }

    function adminManageOwner()
    {
        $owners = Owner::with('account')->get();
        return view('admin.adminManageOwner', compact('owners'));
    }
    function adminManageProperty()
    {
        $properties = Property::with('description')->get();
        return view('admin.adminManageProperty', compact('properties'));
    }
    function adminManageTenant()
    {

        return view('admin.adminManageTenant');
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

                // Switch the order of administrator ID and property ID in the attach method
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


}
