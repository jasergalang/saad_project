@extends('layout.authlayout')

@section('content')
    <div class="container mx-auto p-6 bg-white">
        <h2 class="text-2xl font-semibold mb-4">Edit Rental</h2>

        <form method="POST" action="{{ route('rentals.update', $rental->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="place_name" class="block text-sm font-medium text-gray-600">Place Name:</label>
                <input type="text" name="place_name" id="place_name" value="{{ $rental->place_name }}" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <!-- Add other fields as needed -->
            <!-- Example: -->
            <!-- <div class="mb-4">
                <label for="some_other_field" class="block text-sm font-medium text-gray-600">Some Other Field:</label>
                <input type="text" name="some_other_field" id="some_other_field" value="{{ $rental->some_other_field }}" class="mt-1 p-2 border rounded-md w-full">
            </div> -->

            <button type="submit" class="bg-primary text-white px-4 py-2 mt-4">Update Rental</button>
        </form>
    </div>
@endsection
