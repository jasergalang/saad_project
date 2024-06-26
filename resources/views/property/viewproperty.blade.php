@extends('layout.authlayout')

@section('content')
{{-- login --}}
{{-- login --}}
<div class="flex justify-end px-6 py-4">
    <a href="{{ route('showproperty') }}" class="text-black text-2xl font-semibold">
        <i class="fa-solid fa-circle-xmark mr-5 fa-lg"></i>
    </a>
</div>

<div class="p-3 bg-orange-300">
    {{-- viewing --}}
    <div class="container grid grid-cols-5 gap-6 pt-4 pb-16 mt-20 items-start">
        {{-- product --}}
        <div class="col-span-3 bg-white px-4 py-6 shadow rounded-2xl overflow-hidden hover:scale-105 hover:shadow-2xl transition">

        {{-- imagess --}}

        <div class="container border-b grid grid-cols-1 gap-6 pt-4 pb-3 items-start">
            <div class="gap-6 mt-4">
                <div>
                    {{-- Primary Image --}}
                    <img id="mainImage" class="w-full md:w-full lg:w-4/5 xl:w-3/4 mx-auto transition-transform transform hover:scale-150"
                        src="{{ asset('/storage/images/'.$property->image->image_path) }}" alt="">

                    {{-- Secondary Images --}}
                    <div class="grid grid-cols-5 gap-3 mt-4">
                        @foreach ($relatedImages as $image)
                            <div class="w-full h-24"> <!-- Adjust the height as needed -->
                                <img class="w-full h-full cursor-pointer"
                                    src="{{ asset('/storage/images/'.$image->image_path) }}" alt=""
                                    onclick="swapImages(document.getElementById('mainImage'), this)">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            function swapImages(mainImage, clickedImage) {
                var tempSrc = mainImage.src;
                mainImage.src = clickedImage.src;
                clickedImage.src = tempSrc;
            }
        </script>

            {{-- place title --}}
            <div class="grid grid-cols-1 gap-6 py-4 px-5 items-start">
                <h1 class="text-4xl font-bold text-primary">{{$property->description->title}}y</h1>
            </div>
            {{-- place location/address --}}
            <div class="flex border-b items-center py-2 px-5">
                <i class="text-primary fa-solid fa-location-dot"></i>
                <h1 class="text-xl font-light text-primary px-5">
                    {{ $property->address->unit_number }}, {{ $property->address->floor }}, {{ $property->address->street }}, {{ $property->address->city }}
                </h1>
            </div>

            {{-- table/details --}}


            {{-- i want this table to be stretched --}}
            <div class="flex justify-center items-center">
                <table class="border rounded-lg overflow-hidden w-full">
                    <tr class="border-b">
                      <th class="py-2 px-4 font-semibold text-left">Details</th>
                      <th class="py-2 px-4 font-semibold text-left">Amenities</th>
                      <th class="py-2 px-4 font-semibold text-left">Monthly Rate</th>
                    </tr>
                    <tr>
                      <td class="py-4 px-4 align-top">
                        {{$property->detail->floor_area}}<br>
                        {{$property->detail->furnishing}}<br>
                        {{$property->detail->bedrooms}} Bedrooms<br>
                        {{$property->detail->floor_area}} Bathrooms<br>

                      </td>
                      <td class="py-4 px-4 align-top">
                        @if($property->amenity->balcony)
                        Balcony<br>
                        @endif
                        @if($property->amenity->gym)
                            Gym<br>
                        @endif
                        @if($property->amenity->pool)
                            Pool<br>
                        @endif
                        @if($property->amenity->parking)
                            Parking<br>
                        @endif
                        @if($property->amenity->security)
                            Security<br>
                        @endif
                        @if($property->amenity->pets_allowed)
                            Pets Allowed<br>
                        @endif
                      </td>
                      <td class="py-4 px-4 align-top">
                        ₱30,000
                      </td>
                    </tr>
                </table>
            </div>

        </div>
        {{-- end of product --}}

  {{-- user info --}}
    <div class="col-span-2 bg-white px-4 pb-2 overflow-hidden rounded-2xl hover:scale-105 hover:shadow-2xl transition">

        <div class="grid grid-cols-2 gap-6 pt-4 pb-2 items-start">

            {{-- image --}}
            <div class="col-span-1 bg-white px-2 pb-3 overflow-hidden">
                <div class="flex items-center place-items-center justify-center">
                    <img src="https://www.svgrepo.com/show/507442/user-circle.svg" class="w-24" alt="">
                </div>
            </div>

            {{-- landlord info --}}
            <div class="col-span-1 bg-white pb-3 overflow-hidden">
                <div class="divide-y divide-gray-200 space-y-3">
                    <div class="pt-3">
                        {{-- name --}}
                        <h2 class="text-xl font-semibold">
                            {{ $property->owner->account->fname }} {{ $property->owner->account->lname }}
                        </h2>

                        {{-- status --}}
                        <h4 class="text-xl font-bold">
                            Landlord
                        </h4>\
                        {{-- number --}}
                        <h2 class="text-md font-semibold">
                            {{ $property->owner->account->contact }}
                        </h2>
                        <h2 class="text-md font-semibold">
                            {{ $property->owner->account->email }}
                        </h2>
                    </div>
                </div>
            </div>
            {{-- send inquiry section --}}
            <div class="col-span-2 text-center px-2 pb-3 overflow-hidden">
                {{-- etong link pre kukuhain nalang to dun sa list a property, mag lagay nalang ako dun
                    ng place kung saan nila pwede ilagay, tas dahil soc med to, pweding hindi sila mag
                    lagay, and yung only way to contact nlang sila is yung number  --}}
                <a href="{{ $property->owner->facebook_link }}" class=" bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                    <i class="fab fa-facebook-square mr-2"></i>
                    Facebook
                </a>
            </div>
            <div class="col-span-2 text-center px-2 pb-3 overflow-hidden">
                @php
                $hasInquired = false; // Assuming no inquiry has been made initially

                // Check if the user is authenticated and has already inquired about this property
                if(auth()->check()) {
                    $loggedInUserId = auth()->user()->id;
                        $tenant = \App\Models\Tenant::where('account_id', $loggedInUserId)->first();

                        if ($tenant) {
                            $hasInquired = $tenant->inquiries()->where('property_id', $property->id)->exists();
                        }
                    }
            @endphp

@if(!$hasInquired)
<form action="{{ route('inquire.post') }}" method="post" class="mt-4">
    @csrf
    <input type="hidden" name="property_id" value="{{ $property->id }}">

    @auth
        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
        <label for="name" class="block text-sm font-medium text-gray-700">Your Name:</label>
        <input type="text" name="name" value="{{ auth()->user()->fname }}" readonly class="mt-1 p-2 border rounded w-full" required>
    @endauth

    {{-- <label for="message" class="block text-sm font-medium text-gray-700 mt-4">Message:</label>
    <textarea name="message" rows="4" cols="50" placeholder="Type your message here..." class="mt-1 p-2 border rounded w-full" required></textarea> --}}

    <!-- Add other form fields as needed -->

    <button type="submit" class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center cursor-pointer">
        <i class="fas fa-envelope mr-2"></i>
        Inquire
    </button>
</form>
@else
<a href="{{ route('chat.show', $property->id) }}" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
    <i class="fas fa-comment-alt mr-2"></i>
    Chat with Landlord
</a>
@endif



            </div>



            {{-- end of send inquiry section --}}

        </div>

    </div>
    {{-- end of user info --}}
</div>
{{-- viewing ends --}}

</div>


{{-- @include('layout.footer'); --}}
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

