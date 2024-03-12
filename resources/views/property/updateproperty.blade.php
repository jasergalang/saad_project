@extends('layout.authlayout')

@section('content')
<div class="flex justify-end mt-4 mr-6">
    <a href="{{ route('user') }}" class="text-blue-600 hover:text-blue-800 mr-4">
        <i class="fa-solid fa-arrow-left"></i> Go Back
    </a>
</div>

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

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->all());
            alert(errorMessage.join('\n'));
        </script>
    @endif
@endsection

