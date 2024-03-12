@extends('layout.authlayout')

@section('content')
@include('layout.adminNavbar');
    {{-- SA LOOB NITO YUNG MAIN PAGE --}}
    <div class="content flex-grow p-4 ml-0 bg-transparent pt-20">

        {{-- verifiication wrapper --}}
            <div class="container p-6 mt-10">

                <div class="grid grid-cols-5 gap-4">

                    <div class="col-span-5 bg-transparent rounded-lg shadow-sm">

                        {{-- list nto --}}
                        <div class="px-4 pb-2 overflow-hidden my-3 rounded-2xl">
                            <div class="px-4 pb-2 bg-white rounded-2xl overflow-hidden">
                                <div class="mr-14 flex items-center">
                                    <h3 class="text-xl mt-5 font-semibold">
                                        Property Verification
                                    </h3>
                                </div>
                                <hr class="my-2 text-black bg-black rounded-lg border h-2">
                            </div>

                            <div class="overflow-x-auto my-3 bg-white rounded-lg max-h-[500px] relative">
                                <table class="table-auto w-full border-transparent">
                                    <thead class="sticky top-0 bg-white">
                                        <tr>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">ID</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">Name</th>
                                            <th class="px-4 py-2 text-gray-800 border-b border-r bg-gray-300">Email</th>
                                            <th class="py-2 text-gray-800 border-b bg-gray-300">Verification</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $property)
                                        <tr>
                                            <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                                                <img src="{{asset('/storage/images/' . optional($property->image)->image_path) }}" alt="Property Photo">
                                            </td>
                                            <td class="px-4 py-2 border-b border-gray-400" style="width: 25%;">
                                                {{ $property->owner->account->fname }} {{ $property->owner->account->lname }}
                                            </td>
                                            <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                                                {{ $property->description->title }}
                                            </td>

                                            <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                                @if ($property->verification_status == 'verified')
                                                    Verified
                                                @else
                                                    <form method="POST" action="{{ route('admin.verify.property', ['id' => $property->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
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

                        {{-- properties --}}
                        <div class="px-4 pb-2 overflow-hidden my-3 mt-28 rounded-2xl">
                            <div class="px-4 pb-2 bg-white rounded-2xl overflow-hidden">
                                <div class="mr-14 flex items-center">
                                    <h3 class="text-xl mt-5 font-semibold">
                                        Landlord Verification
                                    </h3>
                                </div>
                                <hr class="my-2 text-black bg-black rounded-lg border h-2">
                            </div>

                            <div class="overflow-x-auto my-3 bg-white rounded-lg max-h-[600px] relative">
                                <table class="table-auto w-full border-transparent">
                                    <thead class="sticky top-0 bg-white">
                                        <tr>
                                            <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 35%;">Place Name</th>
                                            <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 35%;">Owner</th>
                                            <th class="px-4 py-2 border-b border-r border-gray-400 bg-gray-300" style="width: 35%;">Place Name</th>
                                            <th class="py-2 px-3 text-gray-800 border-b border-r  border-gray-400 bg-gray-300" style="width: 15%;">Download Documents</th>

                                            <th class="py-2 px-3 text-gray-800 border-b border-gray-400 bg-gray-300" style="width: 15%;">Verification</th>
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
                                                @if ($owner->file_path)
                                                @php
                                                    $documentPaths = explode(',', $owner->file_path);
                                                @endphp
                                                @if (count($documentPaths) > 0)
                                                    <!-- <a href="{{ asset('/storage/documents/' . implode(',', array_map('trim', $documentPaths))) }}" download>Download All Documents</a> -->
                                                         <a href="{{ route('download.documents', ['ownerId' => $owner->id]) }}" download>Download All Documents</a>
                                                @else
                                                    No Document Available
                                                @endif
                                            @else
                                                No Document Available
                                            @endif
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
        {{-- verifiication wrapper --}}
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

