        {{-- sidebar --}}
        <div class="sidebar fixed top-0 bottom-0 left-[-300px] p-2 w-[300px] overflow-y-auto text-center bg-gray-700 duration-1000">

            <div class="text-white text-xl font-thin">
                <div class="p-2.5 mt-1 flex items-center">
                    <h1 class="font-bold text-white text-[15px] ml-3">Admin</h1>
                    <i class="fa-solid fa-xmark ml-48 cursor-pointer hover:scale-125" onclick="Open()"></i>
                </div>

                <hr class="my-2 text-gray-400">
            </div>

            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 text-white cursor-pointer hover:bg-red-500">
                <i class="fa-solid fa-house"></i>
                <span class="text-[15px] font-semibold ml-8 text-white">Home</span>
            </div>

            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 text-white cursor-pointer hover:bg-red-500">
                <i class="fa-solid fa-house-laptop"></i>
                <span class="text-[15px] font-semibold ml-8 text-white">Rent</span>
            </div>

            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 text-white cursor-pointer hover:bg-red-500">
                <i class="fa-solid fa-house-flag"></i>
                <span class="text-[15px] font-semibold ml-8 text-white">Property</span>
            </div>

            <hr class="my-2 text-gray-400">

            {{-- Verification dropdown --}}
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 text-white">
                <i class="fa-solid fa-check-double"></i>
                <div class="flex justify-between w-full items-center" onclick="dropDown1()">
                    <span class="text-[15px] ml-4 text-white">Verification</span>
                    <span class="text-sm rotate-180" id="arrow">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </div>
            </div>

            <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-white" id="submenu">
                <h1 class="cursor-pointer p-2 hover:bg-red-500 rounded-md mt-1" onclick="scrollToElement('landlordlist')">Landlord Verification</h1>
                <h1 class="cursor-pointer p-2 hover:bg-red-500 rounded-md mt-1" onclick="scrollToElement('propertylist')">Property Verification</h1>
            </div>

            {{-- manage dropdown --}}
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 text-white">
                <i class="fa-solid fa-list-check"></i>
                <div class="flex justify-between w-full items-center" onclick="dropDown2()">
                    <span class="text-[15px] ml-4 text-white">Manage</span>
                    <span class="text-sm rotate-180" id="arrow2">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </div>
            </div>

            <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-white" id="submenu2">
                <h1 class="cursor-pointer p-2 hover:bg-red-500 rounded-md mt-1" onclick="scrollToElement('verilandlordlist')">Landlords</h1>
                <h1 class="cursor-pointer p-2 hover:bg-red-500 rounded-md mt-1" onclick="scrollToElement('verirenterlist')">Renters</h1>
                <h1 class="cursor-pointer p-2 hover:bg-red-500 rounded-md mt-1" onclick="scrollToElement('veripropertylist')">Properties</h1>
            </div>

            @auth
            <!-- Show Logout link for authenticated users -->
            <a href="{{ route('logout') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 text-white">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="text-[15px] ml-4">Logout</span>
            </a>
        @else
            <!-- Show Login link for guests (unauthenticated users) -->
            <a href="{{ route('login') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 text-white">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="text-[15px] ml-4 text-gray-200">Log In</span>
            </a>
        @endauth


        </div>

        {{-- script ng sidebar --}}
        <script type="text/javascript">
            function dropDown1() {
                document.querySelector('#submenu').classList.toggle('hidden')
                document.querySelector('#arrow').classList.toggle('rotate-0')
            }
            dropDown1()

            function dropDown2() {
                document.querySelector('#submenu2').classList.toggle('hidden')
                document.querySelector('#arrow2').classList.toggle('rotate-0')
            }
            dropDown2()

            function Open() {
                var sidebar = document.querySelector('.sidebar');
                sidebar.classList.toggle('-left-0');
                sidebar.classList.toggle('left-[-300px]');

                var content = document.querySelector('.content');
                content.classList.toggle('ml-0');
                content.classList.toggle('lg:ml-[300px]');
            }
        </script>
