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
            <table class="table-auto w-full border-transparent">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 20%;">Contract ID</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Property</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Tenant</th>
                        <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Status</th>
                        <th class="py-2 px-3 text-gray-800 border-b border-r border-gray-400" style="width: 15%;">Payment</th>
                        <th class="py-2 px-3 text-gray-800 border-b border-gray-400" style="width: 15%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-400">{{ $payment->contract->id }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ optional($payment->contract->inquiry->property->description)->title }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ optional($payment->contract->inquiry->tenant->account)->fname }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">{{ $payment->contract->contract_status }}</td>
                            <td class="px-4 py-2 border-b border-gray-400">
                                @if ($payment->balance > 0)
                                <button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                    <a href="{{ route('paymentform', $payment->contract->id) }}" title="Payment Form">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                    </a>
                                </button>
                            @else
                                <button class="bg-gray-300 rounded-md px-5 py-1 cursor-not-allowed" title="Fully Paid" disabled>
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                </button>
                            @endif
                            </td>
                            <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                <button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                    <i class="fa-solid fa-circle-minus"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @if (empty($payments))
                        <tr>
                            <td colspan="4" class="text-center py-4">No Payments found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

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

@if ($errors->any())
    <script>
        var errorMessage = @json($errors->all());
        alert(errorMessage.join('\n'));
    </script>
@endif
@endsection

