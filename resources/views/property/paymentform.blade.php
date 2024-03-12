@extends('layout.authlayout')

@section('content')
<div class="flex justify-end px-6 py-4">
    <a href="{{ route('manageContract') }}" class="text-black text-2xl font-semibold">
        <i class="fa-solid fa-circle-xmark mr-5 fa-lg"></i>
    </a>
</div>

    <form method="post" action="{{ route('payment.submit', ['contractId' => $contract->id]) }}" enctype="multipart/form-data">
        @csrf
    <div class="container mx-auto p-6 bg-white my-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
        <h2 class="text-2xl font-bold mb-4 border-b pb-2">Contract Details</h2>

        <div class="pt-5">
            <label for="contractId" class="text-base font-semibold mr-2">Contract ID:</label>
            <span id="contractId">{{ $contract->id }}</span>
        </div>


            <div class="pt-5">
                <label for="propertyName" class="text-base font-semibold mr-2">Property Name:</label>
                <span id="propertyName">{{ optional($contract->inquiry->property->description)->title }}</span>
            </div>


                <div class="pt-5">
                    <label for="propertyAddress" class="text-base font-semibold mr-2">Property Address:</label>
                    <span id="propertyAddress">
                        {{ $contract->inquiry->property->address->unit_number }},
                        {{ $contract->inquiry->property->address->floor }},
                        {{ $contract->inquiry->property->address->street }},
                        {{ $contract->inquiry->property->address->city }}
                    </span>
                </div>

                <div class="pt-5">
                    <label for="propertyRate" class="text-base font-semibold mr-2">Amount to be Paid</label>
                    <span id="propertyRate">Php {{ $payment ? $payment->balance : $contract->inquiry->property->rate->monthly_rate }}</span>
                </div>
                <div class="pt-5">
                    <label for="amountPaid" class="text-base font-semibold mr-2">Amount Paid:</label>
                    <input type="text" id="amountPaid" name="amount" class="rounded-md border border-gray-300 p-2 w-full" placeholder="Enter the amount paid">
                </div>
                <div class="pt-5">
                    <label for="balance" class="text-base font-semibold mr-2">Balance:</label>
                    <span id="balance" name="balance">$0.00</span>
                </div>


            <div class="pt-5">
                <label for="paymentDate" class="text-base font-semibold mr-2">Payment Date:</label>
                <input type="date" id="paymentDate" name="date" class="rounded-md border border-gray-300 p-2 w-full">
            </div>

            <div class="pt-5">
                <label for="tenantName" class="text-base font-semibold mr-2">Tenant Name:</label>
                <span id="tenantName">{{ $contract->inquiry->tenant->account->fname }} {{ $contract->inquiry->tenant->account->lname }}</span>
            </div>


            <div class="col-span-2 md:col-span-1 pl-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
                {{-- Lease Ageement --}}
                <div class="container mx-auto p-6 bg-white rounded-md my-5">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Payment Receipt</h2>
                    <div class="mt-14">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Allowed file types: PDF, DOCX, JPG, PNG (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="file_path" class="hidden" accept=".pdf, .docx, .jpg, .png" />

                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="pt-5">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md w-full">
                    Submit Payment
                </button>
            </div>
        </form>
    </div>
</div>
{{--
        {{ route('uploadReceipt', ['contract_id' => $contract->id]) }} --}}
    @include('layout.footer')
@endsection


@section('scripts')
    @parent
    <script>
        window.onload = function() {
            var propertyRate = parseFloat('{{ $payment ? $payment->balance : $contract->inquiry->property->rate->monthly_rate }}');
            var amountPaidInput = document.getElementById('amountPaid');
            var balanceSpan = document.getElementById('balance');

            // Function to calculate balance and update UI
            function calculateBalance() {
                // Parse the inputted amount
                var amountPaid = parseFloat(amountPaidInput.value);
                // Calculate the balance by subtracting the amount paid from the total amount
                var balance = propertyRate - amountPaid;
                // Update the UI to display the balance
                balanceSpan.innerText = 'Php ' + balance.toFixed(2);
            }

            // Add input event listener to amountPaid input
            amountPaidInput.addEventListener('input', calculateBalance);

            // Trigger the input event initially to calculate the balance based on any existing value
            amountPaidInput.dispatchEvent(new Event('input'));
        };
    </script>
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

