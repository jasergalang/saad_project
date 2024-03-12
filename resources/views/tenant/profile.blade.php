@extends('layout.authlayout')

@section('content')

@include('layout.tenantHeader')
@include('layout.nav')

{{-- account wrapper --}}
<div class="container p-6 bg-white">
    <div class="container pt-4 pb-4 mx-5">
        <div class="flex items-center">
            <img src="https://www.svgrepo.com/show/507442/user-circle.svg" class="w-40 mr-10" alt="">
            <h3 class="text-xl font-semibold">
                Tenant: {{ $accounts->fname }} {{ $accounts->lname }}
            </h3>
        </div>
    </div>

    <div class="container gap-6 border-t pt-4 pb-16 items-start">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-md font-semibold mb-4">Tenant Profile</h2>
            <div class="bg-white p-4">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Personal Information</h3>
                        <table class="w-full">
                            <tr>
                                <td class="font-semibold">Name:</td>
                                <td>{{ $accounts->fname }} {{ $accounts->lname }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Email:</td>
                                <td>{{ $accounts->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Phone:</td>
                                <td>{{ $accounts->contact }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white px-4 pb-2 overflow-hidden">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-10 font-semibold">
                    Your Contracts
                </h3>
            </div>
        </div>

        <div class="container border rounded-md bg-white py-4 mt-4 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="w-2/6 px-6 py-2 text-center">Property Name</th>
                        <th class="w-1/6 px-6 py-2 text-center">Landlord</th>
                        <th class="w-1/6 px-6 py-2 text-center">Download</th>
                        <th class="w-1/6 px-6 py-2 text-center">Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                    <tr class="border-b">
                        <td class="w-2/6 px-6 py-2 whitespace-normal">{{ $inquiry->property->description->title }} {{ $inquiry->property->description->description }}</td>
                        <td class="w-1/6 px-6 py-2 whitespace-normal text-center">{{ $accounts->fname }} {{ $accounts->lname }}</td>
                        <td class="w-1/6 px-6 py-2 text-center">
                            @if ($inquiry->contract)
                            <a href="{{ route('tenant.download.contract', ['id' => $inquiry->id]) }}" class="text-red-500 hover:underline text-md">
                                Download Contract
                            </a>
                        @else
                            No Contract Available
                        @endif
                        </td>
                        <td class="w-1/6 px-6 py-2 text-center">
                            <form id="upload-form" action="{{ route('tenant.upload.contract', ['id' => $inquiry->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="contract-file" class="text-red-500 hover:underline cursor-pointer text-md">
                                    <span id="file-name-label">Choose a file</span>
                                    <input type="file" id="contract-file" name="contract_file" accept=".pdf" style="display: none;" onchange="updateFileNameLabel()">
                                </label>
                            </form>

                            <script>
                                function updateFileNameLabel() {
                                    var fileNameLabel = document.getElementById('file-name-label');
                                    fileNameLabel.textContent = document.getElementById('contract-file').files[0].name;

                                    document.getElementById('upload-form').submit();
                                }
                            </script>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="bg-white px-4 pb-2 overflow-hidden">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-10 font-semibold">
                    Tenants Table
                </h3>
            </div>
        </div> --}}

        {{-- <div class="container border rounded-md bg-white py-4 mt-4 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-center">Name</th>
                        <th class="px-4 py-2 text-center">Contact No.</th>
                        <th class="px-4 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">John Doe</td>
                        <td class="px-4 py-2 text-center">123-456-7890</td>
                        <td class="px-4 py-2 text-center">Active</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">Jack Smith</td>
                        <td class="px-4 py-2 text-center">456-789-0123</td>
                        <td class="px-4 py-2 text-center">Inactive</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">Jane Black</td>
                        <td class="px-4 py-2 text-center">456-789-0123</td>
                        <td class="px-4 py-2 text-center">Inactive</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div> --}}

    </div>
</div>
{{-- account wrapper --}}
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


