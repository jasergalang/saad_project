<div class="fixed top-0 left-0 right-0 z-10">
    {{-- navbar --}}
    <div class=" bg-white py-5 px-5">
        <div class="flex justify-between items-center">
            <div class="flex-initial flex items-center">
                <img src="https://www.svgrepo.com/show/272028/houses-home.svg" alt="homelogo" class="w-10">
                <h1 class="text-black font-bold text-xl pl-3">ADMIN</h1>
            </div>

            <div class="flex-1 flex justify-center space-x-6">
                <a href="" class="text-black hover:text-gray-300">Dashboard</a>
                <a href="{{ route('adminVerification') }}" class="text-black hover:text-gray-300 ">Verification</a>
                <a href="{{ route('adminManagement') }}" class="text-black hover:text-gray-300">Management</a>
                <a href="{{ route('adminproperty') }}" class="text-black hover:text-gray-300">Properties</a>
            </div>
            <div class="flex-initial">
                @auth
                    <a href="{{ route('logout') }}" class="text-center text-gray-700 hover:text-primary transition relative">
                        <div class="text-2xl">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </div>
                        <div class="text-sx leading-3">Logout</div>
                    </a>
                @else
                    <!-- Show login link for unauthenticated users -->
                    <a href="{{ route('login') }}" class="text-center text-gray-700 hover:text-primary transition relative">
                        <div class="text-2xl">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </div>
                        <div class="text-sx leading-3">Log In</div>
                    </a>
                @endauth
            </div>

        </div>
        <hr class="my-2 text-gray-400">
    </div>
</div>
