<!-- resources/views/chat.blade.php -->

@extends('layout.authlayout') <!-- Replace 'layout.app' with your actual layout file -->

@section('content')

@if ($user->roles == 'tenant' )


<div class="flex justify-center items-center bg-gradient-to-r from-red-500 to-orange-500 h-screen">
    <div class="container mx-auto my-8 hover:scale-105 transition">
        <div class="flex justify-between items-center bg-gray-200 p-4 rounded-t-2xl">
            <h2 class="text-xl font-bold">{{ $property->description->title }}</h2>
            <h2 class="mr-36 text-red-500"><i class="fa-solid fa-message px-3"></i></h2>
            <a href="{{ route('viewproperty', $property->id) }}" class="text-red-500 hover:underline"><i class="fa-solid fa-xmark text-xl hover:scale-105"></i></a>
        </div>
    @elseif ($user->roles == 'owner' )
    <div class="flex justify-center items-center bg-gradient-to-r from-red-500 to-orange-500 h-screen">
    <div class="container mx-auto my-8">
        <div class="flex justify-between items-center bg-gray-200 p-4">
            <h2 class="text-xl font-bold">{{ $property->description->title }} Chat</h2>
            <a href="{{ route('inquiriesform') }}" class="text-red-500 hover:underline"><i class="fa-solid fa-xmark text-xl hover:scale-105"></i></a>
        </div>
    @endif
        <div class="flex flex-col bg-white p-4 rounded shadow-md my-4 rounded-b-2xl">
            <div class="border-b py-2 mb-4">
                <h3 class="text-lg font-semibold">Property Details</h3>
                <p>{{ $property->description->description }}</p>
                <p>{{ $property->address->unit_number }}, {{ $property->address->floor }}, {{ $property->address->street }}, {{ $property->address->city }}</p>
            </div>

            <div class="chat-container mb-4 border-b">
                @foreach ($messages as $message)
                    <div class="flex mb-2">
                        @if($message->sender_id === auth()->user()->id)
                            <div class="flex justify-end w-full">
                                <div class="bg-red-500 text-white py-2 px-4 rounded">
                                    {{ $message->content }}
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start w-full">
                                <div class="bg-gray-200 text-gray-800 py-2 px-4 rounded">
                                    {{ $message->content }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Get the form element by ID
                    var chatForm = document.getElementById('chatForm');

                    // Attach an event listener to the form's submit event
                    chatForm.addEventListener('submit', function () {
                        // After submitting the form, reload the page after a short delay
                        setTimeout(function () {
                            location.reload();
                        }, 1000); // You can adjust the delay time (in milliseconds) as needed
                    });
                });
            </script>

            <form action="{{ route('chat.send') }}" method="post">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <div class="flex items-center">
                    <textarea name="content" class="w-full p-2 border rounded" placeholder="Type your message here..." rows="2"></textarea>
                    <button type="submit" class="ml-2 bg-red-500 text-white py-2 px-4 rounded-xl hover:scale-105">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>



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
