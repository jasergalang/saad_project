@extends('layout.authlayout')

@section('content')

@include('layout.header')

@include('layout.nav')

<form action="{{route('adminregister.post')}}" method="post">
    @if($errors->any())
    <div class="alert alert-danger text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf

{{-- register --}}
<div class="container pt-16 pb-28 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.pexels.com/photos/8292894/pexels-photo-8292894.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
    <div class="max-w-lg mx-auto bg-white shadow-md px-6 py-7 rounded-md overflow-hidden">
        <h2 class="text-2xl uppercase font-medium mb-1">Signup</h2>
        <p class="text-gray-600 mb-6 text-sm">
            Register to
            <span class="font-semibold text-lg text-center text-red-500 mb-2">FindFlat</span>
        </p>

                 <div class="space-y-4">
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">First Name </label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="text" name="fname" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="First Name">
                </div>
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">Last Name </label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="text" name="lname"class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Last Name">
                </div>
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">Email Address</label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="email" name="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Email Address">
                </div>
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">Contact Number</label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="text" name="contact" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Contact">
                </div>
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">Password</label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="password" name="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Password">
                </div>
                <div>
                    <div class="flex">
                        <label class="text-gray-500 mb-2 block">Confirm Password</label>
                        <p class="text-primary">*</p>
                    </div>
                    <input type="password" name="password_confirmation"class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Confirm Password">
                </div>
                <div class="mt-4">
                    <button type="submit"
                    class="block w-full py-2 text-center text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Sign up
                    </button>
                </div>
            </div>


        <p class="mt-4 text-gray-500 text-center">
            Already got an Account? <a href="login" class="text-primary text-semibold">Login Now</a>
        </p>
    </div>
</div>
@include('layout.footer');
@endsection

