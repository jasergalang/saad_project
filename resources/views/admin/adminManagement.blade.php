@extends('layout.authlayout')

@section('content')

@include('layout.adminNavbar');

    {{-- SA LOOB NITO YUNG MAIN PAGE --}}
    <div class="content flex-grow p-4 ml-0 bg-transparent pt-20">

        {{-- manage wrapper --}}
            <div class="container p-6 mt-10">

                <div class="grid grid-cols-5 gap-4">

                    <div class="col-span-5 bg-transparent rounded-lg shadow-sm">

                        {{-- list nto --}}
                        <div class="px-4 pb-2 overflow-hidden my-3 rounded-2xl">
                            <div class="px-4 pb-2 bg-white rounded-2xl overflow-hidden">
                                <div class="mr-14 flex items-center">
                                    <h3 class="text-xl mt-5 font-semibold">
                                        Landlord
                                    </h3>
                                </div>
                                <hr class="my-2 text-black bg-black rounded-lg border h-2">
                            </div>

                            <div class="overflow-x-auto my-3 bg-white rounded-lg max-h-[500px] relative">
                                <table class="table-auto w-full border-transparent">
                                    <thead class="sticky top-0 bg-white">
                                        <tr>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">ID</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Name</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Email</th>
                                            <th class="py-2 text-gray-800 border-b  border-r border-gray-400 bg-gray-300">Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($owners as $owner)
                                        <tr>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->id }}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->account->fname}} {{$owner->account->lname}}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->account->email }}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 text-center bg-gray-300">
                                                <form action="{{ route('admin.destroy.owner', $owner->account->owner->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
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

                        {{-- renters list --}}
                        <div class="px-4 pb-2 overflow-hidden my-3 mt-20 rounded-2xl">
b                                            gg                              <div class="px-4 pb-2 bg-white rounded-2xl overflow-hidden">
                                <div class="mr-14 flex items-center">
                                    <h3 class="text-xl mt-5 font-semibold">
                                        Renters
                                    </h3>
                                </div>
                                <hr class="my-2 text-black bg-black rounded-lg border h-2">
                            </div>

                            <div class="overflow-x-auto my-3 bg-white rounded-lg max-h-[500px] relative">
                                <table class="table-auto w-full border-transparent">
                                    <thead class="sticky top-0 bg-white">
                                        <tr>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">ID</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Name</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Email</th>
                                            <th class="py-2 text-gray-800 border-b border-gray-400 bg-gray-300">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tenants as $tenant)
                                        <tr>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $tenant->id }}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $tenant->account->fname}} {{$tenant->account->lname}}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $tenant->account->email }}</td>
                                            <td class="px-4 py-2 border-b border-gray-400 text-center bg-gray-300">
                                                <form action="{{ route('admin.destroy.tenant', $tenant->account->tenant->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
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

                        {{--  --}}
                        <div class="container mt-8 mx-auto">

                        </div>
                    </div>
                </div>
        {{-- manage wrapper --}}
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

