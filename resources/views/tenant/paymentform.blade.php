@extends('layout.authlayout')

@section('content')

@include('layout.tenantHeader')
@include('layout.nav')

{{-- Payment Form --}}
<div class="container mx-auto p-6 bg-white">
    <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Payment Form</div>

    <div class="mx-36 my-20">

        <div class="mx-10 mt-5 p-10 border border-black rounded-md">

            <div class="text-xs text-gray-600 ml-56 mt-1"></div>

            <div class="flex items-center">
                <div class="text-base font-semibold mb-2">Property Name:</div>
                <i class="fa-solid fa-house-circle-check ml-12"></i>
                <input type="text" disabled value="{{ $property->description->title }}" class="rounded-md border border-gray-300 ml-3 w-96">
            </div>

            <div class="flex items-center my-5">
                <div class="text-base font-semibold mb-2">Address:</div>
                <i class="fa-solid fa-map-location-dot ml-24"></i>
                <input type="text" disabled value="{{ $property->address->unit_number }}" class="rounded-md border border-gray-300 ml-3 w-96">
            </div>

        </div>

        {{-- rental date calculator --}}
        <div class="mx-10 mt-5 p-10 border border-black rounded-md">
            <div class="mb-4 flex space-x-10 items-center">
                <label for="start-date" class="text-base font-semibold">Start Date:</label>
                <input type="date" value="{{ $paymentDate }}" id="start-date" class="form-input rounded px-5">
            </div>

            <label for="duration" class="text-base font-semibold">Duration:</label>
            <div class="mx-14">
                <select id="duration" class="form-select rounded px-11">
                    <option value="" disabled selected hidden>Choose One</option>
                    <optgroup label="Long Term">
                        <option value="365">1 Year</option>
                        <option value="182">6 Months</option>
                    </optgroup>
                    <optgroup label="Short Term">
                        <option value="90">3 Months</option>
                        <option value="60">2 Months</option>
                        <option value="30">1 Month</option>
                        <option value="21">3 Weeks</option>
                        <option value="14">2 Weeks</option>
                        <option value="7">1 Week</option>
                        <option value="6">6 Nights</option>
                        <option value="5">5 Nights</option>
                        <option value="4">4 Nights</option>
                        <option value="3">3 Nights</option>
                        <option value="2">2 Nights</option>
                        <option value="1">1 Night</option>
                    </optgroup>
                </select>
            </div>
            <div class="mb-4 flex space-x-12 items-center">
                <label for="end-date" class="text-base font-semibold">End Date:</label>
                <input type="date" id="end-date"  class="form-input rounded px-5" readonly>
            </div>
        </div>
        {{-- end of rental date calculator --}}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#start-date, #duration').change(function () {
                    var startDate = new Date($('#start-date').val());
                    var duration = parseInt($('#duration').val());
                    var endDate = new Date(startDate.getTime() + (duration * 24 * 60 * 60 * 1000));
                    var endDateFormatted = endDate.toISOString().slice(0, 10);
                    $('#end-date').val(endDateFormatted);
                });
            });
        </script>
<form action="{{ route('submit.payment') }}" method="post" enctype="multipart/form-data">
    @csrf
        {{-- proof of payment --}}
        <div class="mx-10 mt-5 p-10 border border-black rounded-md">
            <div class="text-xs text-gray-600 ml-56 mt-1"></div>
            <div class="flex items-center">
                <div class="text-base font-semibold mb-2">Proof of Payment:</div>
                <i class="fa-solid fa-receipt ml-12"></i>
                <input type="file" name="payment_image" id="file-input" class="hidden">
                <label for="file-input" class="cursor-pointer ml-5 bg-gray-400 hover:bg-primary text-white py-2 px-10 rounded-xl">Choose Image</label>
                <span id="image-name" class="ml-3"></span>
            </div>
        </div>

    </div>
</div>
{{-- end of Rental Rates --}}
<script>
    function displayFileName() {
        const fileInput = document.getElementById('file-input');
        const fileNameSpan = document.getElementById('image-name');

        if (fileInput.files.length > 0) {
            fileNameSpan.textContent = fileInput.files[0].name;
        } else {
            fileNameSpan.textContent = '';
        }
    }
</script>
{{-- Go Button --}}
<div class="container mx-auto p-6 bg-white">

        <!-- Add hidden fields for $contract and $paymentDate -->
        <input type="hidden" name="contract_id" value="{{ $contract->id }}">
        <input type="hidden" name="payment_date" value="{{ $paymentDate }}">
        <button type="submit" class="bg-primary hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 rounded-md">
            Submit Payment
        </button>
</div>
</form>
@include('layout.footer')
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
