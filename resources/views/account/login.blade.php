@extends('layout.authlayout')

@section('content')

@include('layout.header')

@include('layout.nav')

{{-- login --}}
<div class="container py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
        <p class="text-gray-600 mb-6 text-sm">
            Welcome to
            <span class="font-semibold text-lg text-center text-red-500 mb-2">FindFlat</span>
        </p>
        <form action="{{route('login.post')}}" method="post">
            @if($errors->any())
                    <div class="alert alert-danger text-red-500">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

            @csrf

            <div class="space-y-4">
               <div>
                        <label class="text-gray-500 mb-2 block">Email Address</label>
                        <input type="email" name="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Email Address">
                    </div>
                    <div>
                        <label class="text-gray-500 mb-2 block">Password</label>
                        <input type="password" name="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Password">
                    </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="agreement" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="agreement" class="text-gray-500 ml-3 cursor-pointer">Remember me</label>
                    </div>
                    <a href="#" class="text-primary">Forgot Password</a>
                </div>

                <div class="mt-4">
                    <button type="submit"
                    class="block w-full py-2 text-center text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Login
                    </button>
                </div>
            </div>
        </form>
        {{-- login w/ --}}
        {{-- <div class="mt-6 flex justify-center relative">
            <div class="text-gray-600 uppercase px-3 bg-white z-10 relative"> Or Login with</div>
            <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
        </div>
        <div class="flex mt-4 gap-4">
            <a href="#" class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto fonr-medium text-sm hover:bg-blue-700">Facebook</a>
            <a href="#" class="w-1/2 py-2 text-center text-white bg-yellow-600 rounded uppercase font-roboto fonr-medium text-sm hover:bg-yellow-500">Google</a>
        </div> --}}
        {{-- end of login w/ --}}

        <div class="mt-4 text-gray-500 text-center">
            <p>Don't have an Account? <a href="#" class="text-primary text-semibold" onclick="toggleRegisterOptions()">Register Now</a></p>
            <div id="registerOptions" class="hidden mt-4 justify-center">
                <div class="flex mt-4 gap-4">
                    <a href="{{ route('tenantregister') }}" class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto fonr-medium text-sm hover:bg-blue-700">Renter</a>
                    <a href="{{ route('landlordregister') }}" class="w-1/2 py-2 text-center text-white bg-yellow-600 rounded uppercase font-roboto fonr-medium text-sm hover:bg-yellow-500">Landlord</a>
                </div>
            </div>
        </div>

        <script>
            function toggleRegisterOptions() {
                var options = document.getElementById("registerOptions");
                options.classList.toggle("hidden");
            }
        </script>
    </div>
</div>

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
@endsection



