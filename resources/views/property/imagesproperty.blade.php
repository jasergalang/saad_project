@extends('layout.authlayout')

@section('content')
    {{-- login --}}
    @include('layout.header')

    @include('layout.nav')

    {{-- primary photo --}}
    <div class="container mx-auto p-6 bg-white">
        <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Adding Photos</div>

        <div class="mx-auto my-20">
            <div class="mb-6 mx-10">
                <div class="text-sm font-bold flex justify-start items-center mb-2 ml-96">Photos:</div>

                <form method="POST" action="{{ route('addimages.post') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                    <div class="flex justify-center items-center">
                        <div class="relative">
                            <label for="fileInput" class="cursor-pointer">
                                <input type="file" accept=".png, .jpg" id="fileInput" name="images[]" style="display: none;" multiple accept="image/*">
                                <i class="bg-gray-500 hover:bg-transparent text-white hover:text-primary border hover:border-primary font-bold py-2 px-4 rounded-xl flex items-center">
                                    <i class="fa-solid fa-image mr-2"></i>
                                    Select Images
                                </i>
                            </label>
                        </div>
                    </div>


                    <div id="imageContainer" class="border p-4 grid grid-cols-3 gap-4">
                        <!-- Images will be dynamically added here -->
                    </div>

                    <div class="container mx-auto p-6 bg-white">
                        <button type="submit" class="bg-red-500 hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 rounded-md mt-20 mx-auto block">
                            Upload Photos
                        </button>
                    </div>
                </form>
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
@endsection
