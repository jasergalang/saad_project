@extends('layout.authlayout')

@section('content')
    @include('layout.header')
    @include('layout.nav')

    {{-- Listing Area --}}
    <form method="POST" action="{{ route('properties.updatepropertyform', $property->id) }}">
        @method('PUT')
        @csrf

    {{-- Basic Info --}}
    <div class="container mx-auto p-6 bg-white">
        <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Basic Information</div>

        <div class="mx-36 my-20">
            <div class="mb-6 mx-10 flex items-center">
                <div class="text-base font-semibold mb-2">Property Type:</div>
                <select class="ml-7 rounded-md border border-gray-300 p-2 w-96" name="property_type">
                    <option>--Choose One--</option>
                    <option @if($property->property_type == 'Apartment') selected @endif>Apartment</option>
                    <option @if($property->property_type == 'Condominium') selected @endif>Condominium</option>
                    <option @if($property->property_type == 'House') selected @endif>House</option>
                </select>
            </div>

            <div class="mb-6 mx-10">
                <div class="text-base font-semibold mb-2">Rental Terms:</div>
                <div class="ml-36">
                    <label class="flex items-center mb-2">
                        <input type="checkbox" class="mr-2" name="long_term" @if($property->long_term) checked @endif>
                        <span class="font-semibold text-sm">For Long Term</span>
                        <span class="text-xs text-gray-600 ml-1">(minimum of 6 months)</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2" name="short_term" @if($property->short_term) checked @endif>
                        <span class="font-semibold text-sm">For Short Term</span>
                        <span class="text-xs text-gray-600 ml-1">(available for daily, weekly, or monthly rent)</span>
                    </label>
                    <div class="text-xs text-gray-600 mt-1">Tip: You can pick both if applies.</div>
                </div>
            </div>

            <div class="mx-10">
                <div class="flex items-center">
                    <div class="text-base font-semibold mb-2">Minimum Stay:</div>
                    <select id="stayDuration" class="ml-7 rounded-md border border-gray-300 p-2 w-96" name="minimum_stay">
                        <option>--Choose One--</option>
                        <optgroup label="Long Term">
                            <option value="1 Year" @if($property->minimum_stay == '1 Year') selected @endif>1 Year</option>
                            <option value="6 months" @if($property->minimum_stay == '6 months') selected @endif>6 months</option>
                        </optgroup>
                        <optgroup label="Short Term">
                            <option value="3 Months" @if($property->minimum_stay == '3 Months') selected @endif>3 Months</option>
                            <option value="2 Months" @if($property->minimum_stay == '2 Months') selected @endif>2 Months</option>
                            <option value="1 Month" @if($property->minimum_stay == '1 Month') selected @endif>1 Month</option>
                            <option value="3 Weeks" @if($property->minimum_stay == '3 Weeks') selected @endif>3 Weeks</option>
                            <option value="2 Weeks" @if($property->minimum_stay == '2 Weeks') selected @endif>2 Weeks</option>
                            <option value="1 Week" @if($property->minimum_stay == '1 Week') selected @endif>1 Week</option>
                            <option value="6 Nights" @if($property->minimum_stay == '6 Nights') selected @endif>6 Nights</option>
                            <option value="5 Nights" @if($property->minimum_stay == '5 Nights') selected @endif>5 Nights</option>
                            <option value="4 Nights" @if($property->minimum_stay == '4 Nights') selected @endif>4 Nights</option>
                            <option value="3 Nights" @if($property->minimum_stay == '3 Nights') selected @endif>3 Nights</option>
                            <option value="2 Nights" @if($property->minimum_stay == '2 Nights') selected @endif>2 Nights</option>
                            <option value="1 Night" @if($property->minimum_stay == '1 Night') selected @endif>1 Night</option>
                        </optgroup>
                    </select>
                </div>

                <div class="text-xs text-gray-600 ml-36 mt-1">Tip: Indicate how long is your minimum required stay for this property.</div>
            </div>
        </div>
    </div>
    {{-- End of Basic Info --}}

    {{-- Rental Rates --}}
    <div class="container mx-auto p-6 bg-white">
        <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Rental Rates</div>

        <div class="mx-36 my-20">

            <div class="mx-10 mt-5 p-10 border border-black rounded-md">

                <div class="text-xs text-gray-600 ml-56 mt-1">Monthly Rate</div>

                <div class="flex items-center">
                    <div class="text-base font-semibold mb-2">Long Term Rental Rates:</div>
                    <i class="fa-solid fa-peso-sign ml-4"></i>
                    <input type="text" placeholder="" class="rounded-md border border-gray-300 ml-6 w-96" name="monthly_rate" value="{{ $property->rate->monthly_rate }}">
                </div>
            </div>

            <div class="mx-10 mt-5 p-10 border border-black rounded-md">

                <div class="text-xs text-gray-600 ml-56 mt-1">Daily Rate</div>

                <div class="flex items-center">
                    <div class="text-base font-semibold mb-2">Short Term Rental Rates:</div>
                    <i class="fa-solid fa-peso-sign ml-4"></i>
                    <input type="text" placeholder="" class="rounded-md border border-gray-300 ml-6 w-96" name="daily_rate" value="{{ $property->rate->daily_rate }}">
                </div>

                <div class="text-xs text-gray-600 ml-56 mt-5">Weekly Rate</div>
                <div class="mx-48 flex items-center">
                    <i class="fa-solid fa-peso-sign ml-3"></i>
                    <input type="text" placeholder="" class="rounded-md border border-gray-300 ml-6 w-96" name="weekly_rate" value="{{ $property->rate->weekly_rate }}">
                </div>



            </div>

        </div>
    </div>
    {{-- End of Rental Rates --}}

    {{-- Title and desc --}}
    <div class="container mx-auto p-6 bg-white">
        <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Title & Description</div>

        <div class="mx-36 my-20">
            <div class="flex items-center py-3">
                <div class="text-base font-semibold mr-1 mb-2">Title: </div>
                <input type="text" placeholder="" class="rounded-md border border-gray-300 ml-12 w-full" name="title" value="{{ $property->description->title }}">
            </div>

            <div class="text-xs text-gray-600 ml-56 mt-5">Tip: Tell us about the important details about your unit.</div>
            <div class="flex items-center py-3">
                <div class="text-base font-semibold mb-2">Description: </div>
                <textarea placeholder="" class="rounded-md border border-gray-300 ml-10 w-full h-32" name="description">{{ $property->description->description }}</textarea>
            </div>
        </div>
    </div>
    {{-- End of Title and desc --}}

    {{-- Go Button --}}
    <div class="container mx-auto p-3 bg-white">
        <a href="">
            <button class="bg-primary hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 uppercase rounded-md my-5 mx-auto block">
                Update
            </button>
        </a>
    </div>
    {{-- End of Listing Area --}}
</form>
    @include('layout.footer');
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
