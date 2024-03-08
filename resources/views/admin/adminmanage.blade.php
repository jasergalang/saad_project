@extends('layout.authlayout')

@section('content')
{{-- login --}}
@include('layout.header')

@include('layout.nav')
{{-- manage wrapper --}}
<div class="container p-6 bg-white">

    <div class="flex justify-end py-5 mr-5 space-x-3">
        <h3 class="">
            Admin
        </h3>
        <i class="fa-solid fa-user-tie"></i>
    </div>

    <div class="grid grid-cols-5 gap-4">

        <div class="col-span-5 bg-gray-700 rounded-lg shadow-sm">

            <div class="">

                </div>
                    <div class="container flex items-center justify-center w-full my-2 space-x-14">
                        <a href="adminverification" class="text-xl text-gray-200 hover:underline hover:text-white hover:shadow-lg transition">Verification</a>
                        <a href="adminmanage" class="text-xl text-gray-200 hover:underline hover:text-white hover:shadow-lg transition">Manage</a>
                    </div>
                </div>

            </div>


            {{-- list nato ng mga kailangan makita ng admin --}}
            <div class="container mt-3 mx-auto border rounded-sm py-5 border-gray-400 ">
                <div class="px-4 pb-2 overflow-hidden">
                    <div class="mr-14 flex items-center">
                        <h3 class="text-xl mt-5 font-semibold">
                            Landlords
                        </h3>
                    </div>
                </div>

                <div class="overflow-x-auto my-3 bg-gray-300 rounded-lg max-h-[400px]">
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

            <div class="container mt-3 mx-auto border rounded-sm py-5 border-gray-400 ">
                <div class="px-4 pb-2 overflow-hidden">
                    <div class="mr-14 flex items-center">
                        <h3 class="text-xl mt-5 font-semibold">
                            Tenants
                        </h3>
                    </div>
                </div>

                <div class="overflow-x-auto my-3 bg-gray-300 rounded-lg max-h-[400px]">
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

            {{-- properties --}}
            <div class="container mt-8 mx-auto border rounded-sm py-5 border-gray-400">

                <div class="px-4 pb-2 overflow-hidden">
                    <div class="mr-14 flex items-center">
                        <h3 class="text-xl mt-5 font-semibold">
                            Properties
                        </h3>
                    </div>
                </div>

                <div class="overflow-x-auto my-3 bg-gray-300 rounded-lg max-h-[400px]">
                    <table class="table-auto w-full border-transparent">
                        <thead class="sticky top-0 bg-white">
                            <tr>
                                <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 20%;">Photo</th>
                                <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 30%;">Landlord Name</th>
                                <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 35%;">Place Name</th>
                                <th class="py-2 px-3 text-gray-800 border-b border-gray-400 bg-gray-300" style="width: 15%;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                                    <img src="{{ asset('/storage/images/' . optional($property->image)->image_path) }}" alt="Property Photo">
                                </td>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 25%;">
                                    {{ $property->owner->account->fname }} {{ $property->owner->account->lname }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">{{ $property->description->title }}</td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                    <form action="{{ route('admin.destroy.property', $property->id) }}" method="POST">
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
</div>
{{-- manage wrapper --}}

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
@endsection
