@extends('layout.ownerlayout')

@section('content')

@include('layout.ownerheader')

@section('content')
    {{-- primary photo --}}
    <div class="container mx-auto p-6 bg-white my-10 rounded-2xl">
        <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Adding Photos</div>

        <div class="mx-auto my-10">
            <div class="mb-6 mx-10">

                <form method="POST" action="{{ route('addimages.post') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf

                    {{-- make the design of this button your typical image upload button --}}


                    <!-- Add file uploads section -->
                    {{-- <div class="mt-2">
                        <label class="block text-gray-500 mb-2">Upload Documents for Verification</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Allowed file types: SVG, PNG, JPG, GIF, PDF, DOCX (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="uploaded_files[]" class="hidden" accept=".svg, .png, .jpg, .jpeg, .gif, .pdf, .docx" multiple />
                            </label>
                        </div>
                    </div> --}}

                    {{-- di ko alam pano i-transfer to ahahha --}}
                    <div class="flex items-center justify-center mt-10 text-center">
                        <label for="fileInput" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <input type="file" accept=".png, .jpg" id="fileInput" name="images[]" style="display: none;" multiple accept="image/*">
                            <i class="bg-transparent text-gray-500 hover:text-red-500 font-bold h-24 w-full py-2 px-4 rounded-xl flex justify-center items-center">
                                <i class="fa-solid fa-image mr-2"></i>
                                Select Images
                            </i>
                        </label>
                    </div>

                    <div class="text-lg font-bold mb-5 my-10 mx-20 border-b">Selected Photos:</div>

                    <div id="imageContainer" class="border rounded-2xl h-32 p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    </div>

                    <div class="container mx-auto p-6 bg-white">
                        <button type="submit" class="bg-gray-700 hover:bg-red-500 border hover:border-red-500 text-white hover:text-white font-bold py-2 px-4 rounded-2xl w-full h-24 mt-20 mx-auto hover:text-white hover:scale-105 transition block">
                            Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @include('layout.footer') --}}
@endsection
@section('scripts')
    @parent

    <script>
        document.getElementById('fileInput').addEventListener('change', function (e) {
            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = '';

            const files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'object-cover', 'h-32', 'md:h-48', 'lg:h-64');
                    imageContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
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
