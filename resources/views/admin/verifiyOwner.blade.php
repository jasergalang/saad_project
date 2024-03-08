@extends('layout.authlayout')

@section('content')
{{-- login --}}
@include('layout.header')

@include('layout.nav')

{{-- account wrapper --}}
<div class="container p-6 bg-white">
    <div class="grid grid-cols-5 gap-4">
        {{-- <div class="col-span-1 bg-gray-300 rounded-lg shadow-sm p-4 flex flex-col items-center justify-center">

            <div class="flex items-center justify-center">
                <i class="fa-solid fa-user-tie"></i>
                <h3 class="py-5 pl-3 text-xl font-bold uppercase">Admin</h3>
            </div>
        </div> --}}

        <div class="col-span-5 bg-gray-200 rounded-lg shadow-sm">

            <div class="container pt-4 pb-4 mt-5 mx-5" >
                <div class="flex items-center uppercase">
                    <img src="https://www.svgrepo.com/show/41173/admin-with-cogwheels.svg" class="w-40 mr-10" alt="">
                    <h3 class="text-xl font-semibold">
                        Admin
                    </h3>
                </div>
            </div>

            {{-- landlord --}}
            <div class="container mt-8 mx-auto border-t border-gray-400 ">
                <div class="px-4 pb-2 overflow-hidden">
                    <div class="mr-14 flex items-center">
                        <h3 class="text-xl mt-5 font-semibold">
                            Landlord Verification
                        </h3>
                    </div>
                </div>

                <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
                    <table class="table-auto w-full border-transparent">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">ID</th>
                                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Name</th>
                                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Email</th>
                                <th class="py-2 text-gray-800 border-b border-gray-400">Verification</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owners as $owner)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-400">{{ $owner->id }}</td>
                                <td class="px-4 py-2 border-b border-gray-400">
                                    {{ optional($owner->account)->fname }} {{ optional($owner->account)->lname }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-400">
                                    {{ optional($owner->account)->email }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-400 text-center">
                                    @if($owner->verification_status == 'verified')
                                        Verified
                                    @else
                                        <form method="POST" action="{{ route('admin.verify.landlord', ['id' => $owner->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
{{-- account wrapper --}}

@include('layout.footer');
@endsection

@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@endsection
