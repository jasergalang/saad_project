<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\{
    DB, Validator, Storage
};
use App\Models\{
    Rate, Owner, Detail, Address, Amenity, Property, Description, Image, Account, Maintenance
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function createproperty()
    {
        $ownerID = session('ownerID');
        return view('property.createproperty', compact('ownerID'));
    }
    public function imagesproperty()
    {
        $propertyID = session('propertyID');

        return view('property.imagesproperty', compact('propertyID'));
    }
    public function showproperty()
    {
        $properties = Property::with(['owner.account'])
            ->get()
            ->filter(function ($property) {
                return optional($property)->verification_status === 'verified';
            });

        return view('property.showproperty', compact('properties'));
    }
    public function index()
    {
        $properties = Property::with(['owner.account'])
        ->get()
        ->filter(function ($property) {
            return optional($property)->verification_status === 'verified';
        });

        return view('property.index', compact('properties'));
    }

    public function viewproperty($id)
    {
        $property = Property::with('amenity', 'address', 'rate', 'detail', 'description', 'image')->find($id);
        $relatedImages = Image::where('property_id', $id)->get();
        return view('property.viewproperty', compact('property', 'relatedImages'));
    }
    public function propertylisting(Request $request)
    {

        $accounts_id = auth()->id();

        $owner = Owner::where('account_id', $accounts_id)->first();
        if (!$owner) {

            return redirect()->back()->with('error', 'Owner not found.');
        }
        $ownerID = $owner->id;
        $request->validate([
            'property_type' => 'required|string',
            'monthly_rate' => 'required|numeric',
            'pool' => 'nullable|numeric|in:0,1',
            'gym' => 'nullable|numeric|in:0,1',
            'balcony' => 'nullable|numeric|in:0,1',
            'parking' => 'nullable|numeric|in:0,1',
            'pets_allowed' => 'nullable|numeric|in:0,1',
            'security' => 'nullable|numeric|in:0,1',
            'floor_area' => 'required|string',
            'furnishing' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'unit_number' => 'required|string',
            'floor' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'security_deposit' => 'required|numeric',
        ]);


        $owner = Owner::find($ownerID);

        $propertyData = $request->only([
            'property_type'
        ]);
        $property = $owner->properties()->create($propertyData) ;


        $request->session()->put('propertyID', $property->id);

        //amenities
        $propertyId = $property->id;
        $amenityData = [
            'property_id' => $propertyId,
            'gym' => $request->has('gym') ? $request->filled('gym') : 0,
            'pool' => $request->has('pool') ? $request->filled('pool') : 0,
            'parking' => $request->has('parking') ? $request->filled('parking') : 0,
            'balcony' => $request->has('balcony') ? $request->filled('balcony') : 0,
            'security' => $request->has('security') ? $request->filled('security') : 0,
            'pets_allowed' => $request->has('pets_allowed') ? $request->filled('pets_allowed') : 0,
        ];

        $amenity = Amenity::create($amenityData);
        //detail
        $detailData = $request->only([
            'floor_area', 'furnishing', 'bedrooms', 'bathrooms'
        ]);

        $detailData['property_id'] = $propertyId;
        $detail = Detail::create($detailData);

        //description
        $descData = $request->only([
            'title', 'description'
        ]);
        $descData['property_id'] = $propertyId;
        $desc= Description::create($descData);

        //address
        $addressData = $request->only([
            'unit_number', 'floor', 'street', 'city'
        ]);
        $addressData['property_id'] = $propertyId;
        $address = Address::create($addressData);

        //rate
        $rateData = $request->only([
            'monthly_rate'
        ]);
        $rateData['property_id'] = $propertyId;
        $rate = Rate::create($rateData);

        $maintenanceData = $request->only([
            'security_deposit'
        ]);
        $maintenanceData['property_id'] = $propertyId;
        $maintenance = Maintenance::create($maintenanceData);

        // $amenityData = array_merge($request->only(['pool', 'gym', 'parking', 'security', 'balcony', 'pets_allowed']), ['property_id' => $property->id]);
        // foreach ($amenityData as $key => $value) {
        //     $amenityData[$key] = $value ? 1 : 0;
        // }

        // Amenity::create($amenityData);

        // Detail::create(array_merge($request->only(['floor_area', 'furnishing', 'bedrooms', 'bathrooms']), ['property_id' => $property->id]));

        // Description::create(array_merge($request->only(['title', 'description']), ['property_id' => $property->id]));

        // Address::create(array_merge($request->only(['unit_number', 'floor', 'street', 'city']), ['property_id' => $property->id]));

        // Rate::create(array_merge($request->only(['weekly_rate', 'monthly_rate', 'daily_rate']), ['property_id' => $property->id]));

        return redirect()->route('imagesproperty')->with('success', 'Listing created successfully');
    }

    public function addimages(Request $request)
    {
            $propertyID = session('propertyID');
            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $images = $request->file('images');
            if (!empty($images)) {
                foreach ($images as $image) {
                    $imageName = uniqid() . '_' . $image->getClientOriginalName();
                    $image->storeAs('images', $imageName, 'public');

                    Image::create([
                        'property_id' => $propertyID,
                        'image_path' => $imageName,
                    ]);
                }
                return redirect()->route('user')->with('success', 'Images uploaded successfully.');
            }
            return redirect()->route('imagesproperty')->with('error', 'No images were uploaded.');

    }

    public function showrentals(Request $request, $id)
    {
        return redirect()->route('viewproperty', ['id' => $id]);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->back()->with('success', 'Property deleted successfully!');
    }

    public function updateproperty($id)
    {
        $property = Property::with( 'rate', 'description' )->find($id);
        return view('property.updateproperty', compact('property'));
    }
    public function updatepropertyform(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $property->update([
            'property_type' => $request->input('property_type'),
            'long_term' => $request->has('long_term'),
            'short_term' => $request->has('short_term'),
            'minimum_stay' => $request->input('minimum_stay'),
        ]);
        // Update or create property rates
        $property->rate()->updateOrCreate(
            [],
            [
                'daily_rate' => $request->input('daily_rate'),
                'weekly_rate' => $request->input('weekly_rate'),
                'monthly_rate' => $request->input('monthly_rate'),
            ]
        );
        // Update or create property description
        $property->description()->updateOrCreate(
            [],
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]
        );

        // Redirect to a success page or return a response
        return redirect()->route('property.updateproperty', ['property' => $property->id]);
    }

}
