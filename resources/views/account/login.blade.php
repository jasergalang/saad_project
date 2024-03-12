@extends('layout.authlayout')

@section('content')


            <section class="bg-gradient-to-r from-red-600 via-red-500 to-red-800
            min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-5xl p-5">
            {{-- login form --}}
            <div class="md:w-1/2 px-8 md:px-16 pt-20 shadow-xl rounded-l-2xl">
            <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
            <p class="text-gray-600 mb-6 text-sm">
            Welcome to
            <span class="font-semibold text-lg text-center text-red-500 mb-2">FindFlat</span>
            </p>

            {{-- {{route('login.post')}} --}}
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
                class="block w-full py-2 text-center text-white bg-gray-700 underline rounded hover:bg-red-500 hover:text-white hover:scale-105 transition-transform hover:font-bold uppercase font-roboto font-medium">
                    Login
                </button>
            </div>
            </div>
            </form>

            <div class="mt-4 text-gray-500 text-center">
            <p>Don't have an Account? <a href="#" class="text-primary text-semibold" onclick="toggleRegisterOptions()">Register Now</a></p>
            <div id="registerOptions" class="hidden mt-4 justify-center">
            <div class="flex mt-4 gap-4">
                <a href="{{ route('tenantregister') }}" class="w-1/2 py-2 text-center text-white bg-gray-700 rounded uppercase font-roboto fonr-medium text-sm hover:bg-red-500 hover:scale-105 transition-transform hover:font-bold">Renter</a>
                <a href="{{ route('landlordregister') }}" class="w-1/2 py-2 text-center text-white bg-gray-700 rounded uppercase font-roboto fonr-medium text-sm hover:bg-red-500 hover:scale-105 transition-transform hover:font-bold">Landlord</a>
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

            {{-- design image --}}
            <div class="w-1/2">
            <img class="sm:block hidden shadow-xl rounded-r-2xl" src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?q=80&w=1665&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            </div>
            </div>
            </section>

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

