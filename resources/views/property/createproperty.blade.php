@extends('layout.ownerlayout')

@section('content')

@include('layout.ownerheader')
{{-- Listing Area --}}
{{-- basic info --}}
<form method="POST" action="{{ route('propertylisting.post') }}">
@csrf

    <div class="container py-6 space-x-5 space-y-5 bg-white">

        <div class="grid grid-cols-2">
            {{-- basic info --}}
            <div class=" p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
                <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Basic Information</div>
                    <div class="mx-5 my-10">
                        <div class="py-3 mb-6">
                            <div class="text-base font-semibold mb-2">Property Type: </div>
                            <select name="property_type" class=" rounded-md border border-gray-300 p-2 w-full">
                                <option>--Choose One--</option>
                                <option>Apartment</option>
                                <option>Condominium</option>
                                <option>House</option>
                            </select>
                        </div>
                    </div>
            </div>
            {{-- end of Basic Info --}}

            {{-- Rental Rates --}}
            <div class=" p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
                <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Rental Rate</div>
                <div class="mx-5 my-10">
                    <div class="text-base font-semibold">Monthly Rate:</div>

                    <div class="flex items-center py-5">
                        <i class="fa-solid fa-peso-sign"></i>
                        <input type="text" name="monthly_rate" placeholder="" class="rounded-md border border-gray-300 ml-5 w-full ">
                    </div>

                </div>
            </div>
        </div>

        {{-- loca and add info --}}
        <div class="p-6 pt-5 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Location and Address</div>

            <div class="grid grid-cols-2">
                <div class="mx-5 my-10">
                    <div class="py-3">
                        <div class="text-base font-semibold mr-1 mb-2">Unit Number or House Number: </div>
                        <input type="text" name="unit_number" placeholder="" class="rounded-md border border-gray-300 w-full">
                    </div>

                    <div class="py-3">
                        <div class="text-base font-semibold mb-2">Floor: </div>
                        <input type="text" name="floor" placeholder="" class="rounded-md border border-gray-300 w-full">
                    </div>
                </div>

                <div class="mx-5 my-10">
                    <div class="py-3">
                        <div class="text-base font-semibold mb-2">Street, neighborhood & Barangay: </div>
                        <input type="text" name="street" placeholder="" class="capitalize rounded-md border border-gray-300 w-full">
                    </div>

                    <div class="py-3">
                        <div class="text-base font-semibold mr-3 mb-2">City: </div>
                        <input type="text" name="city" placeholder="" class="capitalize rounded-md border border-gray-300 w-full">
                    </div>
                </div>
            </div>

        </div>

        {{-- Rental Rates --}}
        <div class=" p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Security Deposit</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mr-1 mb-2">Amount: </div>
                    <div class="flex items-center py-5">
                        <i class="fa-solid fa-peso-sign"></i>
                        <input type="text" name="security_deposit" placeholder="" class="rounded-md border border-gray-300 ml-5 w-full">
                    </div>
            </div>
        </div>

        {{-- loca and add info --}}
        <div class="p-6 pt-5 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Property Details</div>

            <div class="container grid grid-cols-3 gap-6 pt-4 pb-16 items-start">

                <div class="col-span-2 bg-white px-4 pb-2 border-r overflow-hidden">
                    <div class="space-y-3 py-3">
                        <div class="text-base font-semibold mr-4">Floor Area (in sqm.): </div>
                        <input type="text" name="floor_area" placeholder="" class="rounded-md border border-gray-300 w-full">
                    </div>

                    <div class="space-y-3 py-3">
                        <div class="text-base font-semibold mr-4">Furnishing: </div>
                        <select name="furnishing" class="rounded-md border border-gray-300 p-2 w-full">
                            <option>--Choose One--</option>
                            <option>Fully Furnished</option>
                            <option>Semi Furnished</option>
                            <option>Unfurnished</option>
                        </select>
                    </div>

                    <div class="space-y-3 py-3">
                        <div class="text-base font-semibold">Bedrooms: </div>
                        <select name="bedrooms" class="rounded-md border border-gray-300 p-2 w-full">
                            <option>--Choose One--</option>
                            <option>none</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5+</option>
                        </select>
                    </div>

                    <div class="space-y-3 py-3">
                        <div class="text-base font-semibold">Bathrooms: </div>
                        <select name="bathrooms" class="rounded-md border border-gray-300 p-2 w-full">
                            <option>--Choose One--</option>
                            <option>none</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5+</option>
                        </select>
                    </div>
                </div>

                {{-- Amenities checkboxes --}}
                <div class="col-span-1 bg-white px-4 pb-2 overflow-hidden">
                    <div class="text-md font-semibold my-3">Unit Amenities</div>

                    <div class="flex flex-col space-y-2 mx-5">
                        {{-- Add checkboxes with appropriate names --}}
                        <label class="flex items-center">
                            <input type="checkbox" name="balcony" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">Balcony</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="pool" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">Swimming Pool</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="gym" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">Gym</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="security" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">24/7 Security</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="parking" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">Parking</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="pets_allowed" class="form-checkbox h-4 w-4 text-indigo-600">
                            <span class="ml-2">Pets Allowed</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class=" p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 my-10 mx-5 border-b">Title & Description</div>

            <div class="mx-36 my-20">
                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mr-1 mb-2">Title: </div>
                    <input type="text" name="title" placeholder="" class="capitalize rounded-md border border-gray-300 ml-12 w-full">
                </div>

                <div class="text-xs text-gray-600 ml-56 mt-5">Tip: Tell us about the important details about your unit.</div>

                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mb-2">Description: </div>
                    <textarea name="description" placeholder="" class="capitalize rounded-md border border-gray-300 ml-10 w-full h-32"></textarea>
                </div>
            </div>
        </div>

        {{-- Go Button --}}
            <div class="container mx-auto p-6 bg-white">
                <a href="" class="text-center text-gray-700 hover:text-primary transition relative">
                <button type="submit" class="uppercase bg-gray-700 hover:bg-red-500 border hover:border-red-500 text-white hover:text-white hover:scale-105 transition font-bold py-2 px-4 w-full h-24 rounded-md my-10 mx-auto block">
                    Create listing and proceed to adding photos
                </button>
            </a>
            </div>

    </div>

</form>
{{-- End of Listing Area --}}

{{-- @include('layout.footer') --}}
@endsection
@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
@endsection
@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->all());
            alert(errorMessage.join('\n'));
        </script>
    @endif
@endsection
