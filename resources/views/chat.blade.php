@extends('layout.authlayout')

@section('content')

<!-- chat.blade.php -->
<div class=" w-1/2 mx-auto my-auto flex flex-col h-screen">
    <div class="bg-gray-800 text-white p-4">
        <h1 class="text-xl font-semibold">Chat with </h1>
    </div>

    <div class="flex-1 overflow-y-scroll p-4">
        {{-- @foreach ($messages as $message)
            <div class="mb-2">
                <p class="bg-blue-500 text-white px-3 py-2 rounded-lg inline-block">
                    {{ $message->user->name }}: {{ $message->message }}
                </p>
            </div>
        @endforeach --}}
    </div>

    {{-- <form action="/send-message" method="post" class="bg-gray-200 p-4">
        @csrf --}}
        <input type="hidden" name="receiver_id" value="">
        <textarea name="message" class="w-full border rounded p-2" placeholder="Type your message..." required></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded-full mt-2">Send</button>
    {{-- </form> --}}
</div>
@include('layout.footer')
@endsection
