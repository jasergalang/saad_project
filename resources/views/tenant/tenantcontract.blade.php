@extends('layout.authlayout')

@section('content')


    <form action="{{ route('createcontract', ['inquiry_id' => $inquiries_id]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="container grid grid-cols-2 gap-4 pl-10">
            <div class="col-span-2 md:col-span-1">
                {{-- Property Information --}}
                <div class="container mx-auto p-6 bg-white my-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Property Information</h2>

                    <div class="pt-5">
                        <label for="propertyTitle" class="text-base font-semibold mr-2">Property:</label>
                        <input type="text" id="propertyTitle" disabled value="{{ $propertyTitle }}" class="hover:border-red-500 rounded-md border border-gray-300 p-2 w-full" readonly><br>

                    </div>
                    <div class="pt-5">
                        <label for="propertyTitle" class="text-base font-semibold mr-2">Unit Number:</label>
                        <input type="text" id="propertyTitle" disabled value="{{ $propertyAddress->unit_number }}" class="hover:border-red-500 rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>
                    <div class="pt-5">
                        <label for="propertyTitle" class="text-base font-semibold mr-2">Floor:</label>
                        <input type="text" id="propertyTitle" disabled value="{{ $propertyAddress->floor }}" class="hover:border-red-500 rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>
                    <div class="pt-5">
                        <label for="propertyTitle" class="text-base font-semibold mr-2">Street:</label>
                        <input type="text" id="propertyTitle" disabled value=" {{ $propertyAddress->street }}" class="hover:border-red-500 rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>
                    <div class="pt-5">
                        <label for="propertyTitle" class="text-base font-semibold mr-2">City:</label>
                        <input type="text" id="propertyTitle" disabled value=" {{ $propertyAddress->city }}" class="hover:border-red-500 rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>
                </div>
            </div>

            <div class="col-span-2 md:col-span-1 pr-10">
                 {{-- Tenant Information --}}
                <div class="container mx-auto p-6 bg-white my-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Tenant Information</h2>

                    <div class="pt-5">
                        <label for="tenantName" class="text-base font-semibold mr-2">Name of Tenant:</label>
                        <input type="text" id="tenantName" disabled value="{{ $tenantDetails->fname }} {{ $tenantDetails->lname }}" class="rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>

                    <div class="pt-5">
                        <label for="tenantContactNumber" class="text-base font-semibold mr-2">Contact Number:</label>
                        <input type="text" id="tenantContactNumber" disabled value="{{ $tenantDetails->contact }}" class="rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>

                    <div class="pt-5">
                        <label for="tenantEmail" class="text-base font-semibold mr-2">Email:</label>
                        <input type="text" id="tenantEmail" disabled value="{{ $tenantDetails->email }}" class="rounded-md border border-gray-300 p-2 w-full" readonly>
                    </div>
                </div>
            </div>

            <div class="col-span-2 md:col-span-1">
                {{-- Rent Duration --}}
                <div class="container mx-auto p-6 bg-white rounded-md my-5 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Rent Duration</h2>

                    <div class="pt-5">
                        <label for="startDate" class="text-base font-semibold mr-2">Start Date:</label>
                        <input type="date" id="startDate" name="start_date" class="rounded-md border border-gray-300 p-2 w-full">
                    </div>

                    <div class="pt-5">
                        <label for="endDate" class="text-base font-semibold mr-2">End Date:</label>
                        <input type="date" id="endDate" name="end_date" class="rounded-md border border-gray-300 p-2 w-full">
                    </div>
                </div>
            </div>

            <div class="col-span-2 md:col-span-1 pl-10 rounded-2xl hover hover:scale-105 hover:shadow-2xl transition">
                {{-- Lease Ageement --}}
                <div class="container mx-auto p-6 bg-white rounded-md my-5">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Lease Agreement</h2>
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
                                <input id="dropzone-file" type="file" name="uploaded_files[]" class="hidden" accept=" .pdf, .docx" multiple />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Submit Button --}}
        <div class="container mx-auto p-6 bg-white rounded-md  my-10">
            <button type="submit" class="bg-primary hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 rounded-md w-full">
                Create Contract
            </button>
        </div>
    </form>

    @include('layout.footer')
@endsection

@section('scripts')
    @parent
    <script>
        function displayFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById('file-name').innerHTML = fileName;
        }
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
