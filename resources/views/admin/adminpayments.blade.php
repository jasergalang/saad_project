@extends('layout.authlayout')

@section('content')
    @include('layout.adminNavbar')

    <div class="content flex-grow ml-0 bg-transparent pt-20">
        <div class="container p-6">
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-5 bg-white rounded-lg p-10 shadow-sm">

                    {{-- Payment Details --}}
                    <div class="px-4 pb-2 overflow-hidden my-3 rounded-2xl hover:scale-105 hover:shadow-2xl transition">
                        <div class="px-4 pb-2 bg-white rounded-2xl overflow-hidden">
                            <div class="mr-14 flex items-center">
                                <h3 class="text-xl mt-5 font-semibold">
                                    Payment Details
                                </h3>
                            </div>
                            <hr class="my-2 text-black bg-black rounded-lg border h-2">
                        </div>

                        <div class="overflow-x-auto my-3 bg-white rounded-lg max-h-[500px] relative">
                            <table class="table-auto w-full border-transparent">
                                <thead class="sticky top-0 bg-white">
                                    <tr>
                                        <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">ID</th>
                                        <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">Tenant Name</th>
                                        <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">Landlord Name</th>
                                        <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">Property ID</th>
                                        <th class="px-4 py-2 text-gray-800 border-b bg-gray-300">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->contract->inquiry->tenant->account->fname }} {{ $payment->contract->inquiry->tenant->account->lname }}</td>
                                        <td>{{ $payment->contract->inquiry->property->owner->account->fname }} {{ $payment->contract->inquiry->property->owner->account->lname }}</td>
                                        <td>{{ $payment->contract->inquiry->property->id }}</td>
                                        <td>{{ $payment->amount }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
