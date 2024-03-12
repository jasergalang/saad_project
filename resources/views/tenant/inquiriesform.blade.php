@extends('layout.authlayout')
@section('content')
@include('layout.ownerheader')



<div class="container p-6 bg-white">
    <div class="container mt-32 mx-auto border rounded-sm py-10 mb-20 hover:scale-105 hover:shadow-2xl bg-white hover:rounded-2xl transition border-gray-400 ">
        <div class="px-4 pb-2 overflow-hidden">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-5 font-semibold">
                    Pending Inquiries
                </h3>
            </div>
        </div>

    <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
        <table class="table-auto w-full border-transparent">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">ID</th>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Tenant Name</th>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Property Title</th>
                    <th class="py-2 text-gray-800 border-b border-r border-gray-400">Chat</th>
                    <th class="py-2 text-gray-800 border-b border-r border-gray-400">Accept</th>
                    <th class="py-2 text-gray-800 border-b border-gray-400">Reject</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries->where('inquiry_status', 'pending') as $inquiry)
                <tr>
                    <td class="px-4 py-2 border-b border-gray-400">{{ $inquiry->id }}</td>
                    <td class="px-4 py-2 border-b border-gray-400">{{ optional($inquiry->tenant->account)->fname }} {{ optional($inquiry->tenant->account)->lname }}</td>
                    <td class="px-4 py-2 border-b border-gray-400">{{ optional($inquiry->property->description)->title }}</td>
                    <td class="px-4 py-2 border-b border-gray-400 text-center">
                        <a href="{{ route('chat.show', $inquiry->id) }}" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                            <i class="fa-solid fa-comments"></i>
                        </a>
                    </td>
                    <td class="px-4 py-2 border-b border-gray-400 text-center">
                        <form action="{{ route('inquiries.accept', $inquiry->id) }}" method="post">
                            @csrf
                            <button type="submit" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-2 border-b border-gray-400 text-center">
                        <form action="{{ route('inquiries.reject', $inquiry->id) }}" method="post">
                            @csrf
                            <button href="{{ route('tenantcontract') }}" type="submit" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <div class="container mb-48 mx-auto border rounded-sm py-10 mt-48  hover:scale-105 hover:shadow-2xl bg-white hover:rounded-2xl border-gray-400 ">
        <div class="px-4 pb-2 overflow-hidden">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-5 font-semibold">
                Accomodated Inquiries
            </h3>
        </div>
    </div>
    <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
    <table class="table-auto w-full border-transparent">
        <thead>
            <tr>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">ID</th>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Tenant Name</th>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Property Title</th>
                <th class="py-2 text-gray-800 border-b border-r border-gray-400">Chat</th>

                <th class="py-2 text-gray-800 border-b border-r border-gray-400">Status</th>
                <th class="py-2 text-gray-800 border-b border-r border-gray-400">Create Contract</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries->where('inquiry_status', 'accepted' || 'rejected') as $inquiry)
            @if ($inquiry->inquiry_status === 'rejected' || $inquiry->inquiry_status === 'accepted')
            <tr>
                <td class="px-4 py-2 border-b border-gray-400">{{ $inquiry->id }}</td>
                <td class="px-4 py-2 border-b border-gray-400">{{ optional($inquiry->tenant->account)->fname }} {{ optional($inquiry->tenant->account)->lname }}</td>
                <td class="px-4 py-2 border-b border-gray-400">{{ optional($inquiry->property->description)->title }}</td>
                <td class="px-4 py-2 border-b border-gray-400 text-center">
                    <a href="{{ route('chat.show', $inquiry->id) }}" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                        <i class="fa-solid fa-comments"></i>
                    </a>
                </td>
                <td class="px-4 py-2 border-b border-gray-400">{{ $inquiry->inquiry_status }}</td>
                <td class="px-4 py-2 border-b border-gray-400 text-center">
                    <a href="{{ route('tenantcontract', ['inquiry_id' => $inquiry->id]) }}" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                        <i class="fa-solid fa-file-contract"></i>
                    </a>
                </td>
            </tr>
            @endif
            @endforeach
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

