@extends('layout.authlayout')
@section('content')

@include('layout.ownerheader')
<div class="container gap-6 border-t pt-4 pb-16 items-start">
    <div class="bg-white px-4 pb-2 overflow-hidden">
        <div class="mr-14">
            <h3 class="text-xl font-semibold">
                Payment Management
            </h3>
        </div>

        <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
            <h4 class="font-semibold mb-3">Total Income by Property Type:</h4>
            @php
                $totalIncomeByPropertyType = [];
                foreach ($payments as $payment) {
                    $propertyType = optional($payment->contract->inquiry->property)->property_type;
                    $totalIncomeByPropertyType[$propertyType] = ($totalIncomeByPropertyType[$propertyType] ?? 0) + $payment->amount;
                }
            @endphp

            <table class="table-auto w-full border-transparent mt-5">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 20%;">Contract ID</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Property</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Property Type</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Tenant</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Status</th>
                        <th class="py-2 px-3 text-gray-800 border-b border-r border-gray-400" style="width: 15%;">Amount</th>
                        <th class="py-2 px-3 text-gray-800 border-b border-r border-gray-400" style="width: 15%;">Payments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-400">{{ $payment->contract->id }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ optional($payment->contract->inquiry->property->description)->title }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ optional($payment->contract->inquiry->property)->property_type }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ optional($payment->contract->inquiry->tenant->account)->fname }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ $payment->contract->contract_status }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ $payment->amount }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">
                                <button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                    <a href="{{ route('paymentform', $payment->contract->id) }}" title="Payment Form">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @if (empty($payments))
                        <tr>
                            <td colspan="5" class="text-center py-4">No Payments found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <ul>
            @php
                $totalAllIncome = 0;
            @endphp

            @foreach ($totalIncomeByPropertyType as $propertyType => $totalIncome)
                <li>{{ $propertyType }}: Php{{ $totalIncome }}</li>
                @php
                    $totalAllIncome += $totalIncome;
                @endphp
            @endforeach

            <li><strong>Total: Php{{ $totalAllIncome }}</strong></li>
        </ul>

        <div class="mt-10">
            <canvas id="incomeChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

@include('layout.footer')
@endsection

@section('scripts')
@parent

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('incomeChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($totalIncomeByPropertyType)) !!},
            datasets: [{
                label: 'Total Income',
                data: {!! json_encode(array_values($totalIncomeByPropertyType)) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
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
