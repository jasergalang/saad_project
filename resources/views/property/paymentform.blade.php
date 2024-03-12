@extends('layout.authlayout')

@section('content')
    @include('layout.header')
    @include('layout.ownernav')

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
                <span id="propertyRate">${{ $contract->inquiry->property->rate->monthly_rate }}</span>
            </div>
            <div class="pt-5">
                <label for="amountPaid" class="text-base font-semibold mr-2">Amount Paid:</label>
                <input type="text" id="amountPaid" name="amountPaid" class="rounded-md border border-gray-300 p-2 w-full" placeholder="Enter the amount paid">
            </div>
            <div class="pt-5">
                <label for="tenantName" class="text-base font-semibold mr-2">Tenant Name:</label>
                <span id="tenantName">{{ $contract->inquiry->tenant->account->fname }} {{ $contract->inquiry->tenant->account->lname }}</span>
            </div>


        <div class="col-span-2 md:col-span-1 pl-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
            {{-- Payment Receipt --}}
            <div class="container mx-auto p-6 bg-white rounded-md my-5">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2"> Payment Receipt</h2>
                <div class="mt-14">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Allowed file types: PDF, DOCX (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" name="receipt" class="hidden" accept=" .pdf, .docx" multiple />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <button id="checkBalance" class="bg-primary hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 rounded-md w-full">
                Check Balance
            </button>
            <span id="balanceMessage" class="text-red-500"></span>
        </div>
    </div>
</div>
{{--
        {{ route('uploadReceipt', ['contract_id' => $contract->id]) }} --}}
    @include('layout.footer')
@endsection


@section('scripts')
    @parent
    <script>
        document.getElementById('checkBalance').addEventListener('click', function () {
            var amountPaid = parseFloat(document.getElementById('amountPaid').value);
            var propertyRate = parseFloat('{{ $contract->inquiry->property->rate->monthly_rate }}');

            if (isNaN(amountPaid)) {
                document.getElementById('balanceMessage').innerText = 'Please enter a valid amount.';
            } else {
                var balance = propertyRate - amountPaid;
                if (balance >= 0) {
                    document.getElementById('balanceMessage').innerText = 'Amount paid successfully. Balance: $' + balance;
                } else {
                    document.getElementById('balanceMessage').innerText = 'Insufficient amount. Remaining balance: $' + Math.abs(balance);
                }
            }
        });
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
