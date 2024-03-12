@extends('layout.authlayout')

@section('content')

{{-- @include('layout.header')

@include('layout.nav') --}}

<form action="{{route('tenantregister.post')}}" method="post">
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

{{-- is there bigger that 96 for ml? --}}

{{-- make a div here that is behiind every other diiv --}}


{{-- how do i make a background for this --}}

<div class="bg-cover bg-no-repeat py-1" style="background-image: url('https://images.unsplash.com/photo-1695221605794-08deb7e35b4f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
    <div class="pt-11 pb-11">
        <div class="max-w-3xl mx-auto backdrop-filter md:backdrop-blur-xl rounded-2xl px-6 py-7 overflow-hidden ">

            <div class="max-w-2xl mx-auto bg-white rounded-2xl px-6 py-7 overflow-hidden">
                <h2 class="text-2xl uppercase font-medium mb-1">Signup</h2>
                <p class="text-gray-500 mb-6 text-sm">
                    Register to
                    <span class="font-semibold text-lg text-center text-red-500 mb-2">FindFlat</span>
                </p>

                <div class="space-y-4">

                    {{-- first and last name --}}
                    <div class="grid grid-cols-2 space-x-2">
                        <div class="col-span-1">
                            <div class="flex">
                                <label class="text-gray-500 mb-2 block">First Name </label>
                                <p class="text-primary">*</p>
                            </div>
                            <input type="text" name="fname" class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="First Name">
                        </div>

                        <div class="col-span-1">
                            <div class="flex">
                                <label class="text-gray-500 mb-2 block">Last Name </label>
                                <p class="text-primary">*</p>
                            </div>
                            <input type="text" name="lname"class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Last Name">
                        </div>
                    </div>

                    <div>
                        <div class="flex">
                            <label class="text-gray-500 mb-2 block">Email Address</label>
                            <p class="text-primary">*</p>
                        </div>
                        <input type="email" name="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Email Address">
                    </div>
                    <div>
                        <div class="flex">
                            <label class="text-gray-500 mb-2 block">Contact Number</label>
                            <p class="text-primary">*</p>
                        </div>
                        <input type="text" name="contact" class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Contact">
                    </div>
                    <div>
                        <div class="flex">
                            <label class="text-gray-500 mb-2 block">Password</label>
                            <p class="text-primary">*</p>
                        </div>
                        <input type="password" name="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Password">
                    </div>
                    <div>
                        <div class="flex">
                            <label class="text-gray-500 mb-2 block">Confirm Password</label>
                            <p class="text-primary">*</p>
                        </div>
                        <input type="password" name="password_confirmation"class="block w-full border border-gray-300 px-4 py-3 text-gray-500 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Confirm Password">
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                        class="block w-full py-2 text-center text-white bg-red-600 border border-primary rounded hover:scale-105 hover:font-bold transition uppercase font-roboto font-medium">
                            Sign up
                        </button>
                    </div>
                </div>

                <p class="mt-4 text-gray-500 text-center">
                    Already got an Account? <a href="{{route('login')}}" class="text-primary text-semibold">Login Now</a>
                </p>
            </div>
        </div>
    </div>
</div>
{{-- end of register --}}

{{-- @include('layout.footer'); --}}
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

