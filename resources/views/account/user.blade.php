@extends('layout.authlayout')

@section('content')

@include('layout.header')

@include('layout.ownernav')


{{-- account wrapper --}}
<div class="container p-6 bg-white">
    <div class="container pt-4 pb-4 mx-5" >
        <div class="flex items-center">
            <img src="https://www.svgrepo.com/show/507442/user-circle.svg" class="w-40 mr-10" alt="">
            <h3 class="text-xl font-semibold">
                John Doe
            </h3>
            <i class="fa-solid fa-minus mx-4"></i>
            <h5 id="editProfileButton" class="text-sm font-light text-gray-600 hover:text-primary cursor-pointer">
                Edit Profile
            </h5>
        </div>

        {{-- Edit Profile form container --}}
        <div id="editProfileContainer" class="hidden absolute bg-white rounded-lg shadow-md p-10 w-104 mt-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
            <button id="closeProfileButton" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="profilePicture" class="block text-sm font-medium text-gray-700">Profile Picture:</label>
                    <input type="file" id="profilePicture" name="profilePicture" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition duration-300">Save Changes</button>
            </form>
        </div>

    </div>
</div>
</div>

<script>
document.getElementById('editProfileButton').addEventListener('click', function() {
    var container = document.getElementById('editProfileContainer');
    container.classList.toggle('hidden');
});

document.getElementById('closeProfileButton').addEventListener('click', function() {
    var container = document.getElementById('editProfileContainer');
    container.classList.add('hidden');
});
</script>


    <div class="container gap-6 border-t pt-4 pb-16 items-start">

        <div class=" bg-white px-4 pb-2 overflow-hidden">
            <div class="mr-14">
                <h3 class="text-xl font-semibold">
                   Property Lists
                </h3>
            </div>
            <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
                <table class="table-auto w-full border-transparent">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 20%;">Photo</th>
                            <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Place Name</th>
                            <th class="py-2 px-3 text-gray-800 border-b  border-r border-gray-400" style="width: 15%;">Update</th>
                            <th class="py-2 px-3 text-gray-800 border-b border-r border-gray-400" style="width: 15%;">Delete</th>
                            <th class="py-2 px-3 text-gray-800 border-b border-r border-gray-400" style="width: 15%;">Restore</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                                    <img src="{{ asset("/storage/images/". $property->image->image_path) }}" alt="Property Photo">
                                </td>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">{{ $property->description->description }}</td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                    <a href="{{ route('property.updateproperty', $property) }}" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                    @if(!$property->trashed()) {{-- Check if property is not in trash --}}
                                    <form action="{{ route('properties.destroy', $property) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                    </form>
                                @endif
                                </td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                                    @if($property->trashed())
                                        <form action="{{ route('properties.restore', $property->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                                <i class="fas fa-undo"></i>
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

        <div class="container border-t border-b rounded-md bg-white h-24">
            {{-- idk --}}
        </div>

        <div class=" bg-white px-4 pb-2 overflow-hidden ">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-10 font-semibold">
                    Reviews and Feedback
                </h3>
            </div>
        </div>

        <div class="container border-t border-b rounded-md bg-white h-24">
            {{-- idk --}}
        </div>

        <div class="bg-white px-4 pb-2 overflow-hidden">
            <div class="mr-14 flex items-center">
                <h3 class="text-xl mt-10 font-semibold">
                    Tenants Table
                </h3>
            </div>
        </div>

        <div class="container border rounded-md bg-white py-4 mt-4 overflow-hidden">
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
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    @if ($errors->any())
    <script>
        var errorMessage = @json(json_decode($errors->toJson(), true));
        alert(errorMessage.join('\n'));
    </script>
@endif

@endsection
