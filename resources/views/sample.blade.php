<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>FindFlat</title>


   <link rel="stylesheet" href="{{ asset('css/app.css') }}">


   <script src="https://cdn.tailwindcss.com"></script>
   <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="bg-white">
    {{-- ito yung header ng page 1 --}}
    <header class="py-1 shadow-sm bg-white">
        <div class="container flex items-center justify-between">
            {{-- logo --}}
            <a href="#">
                <img src="https://www.svgrepo.com/show/272028/houses-home.svg" alt="homelogo" class="w-16">
                <h1 class="text-gray-700 hover:text-red-500 transision">FindFlat</h1>
            </a>


            {{-- search area --}}
            <div class="w-full max-w-xl relative flex">
                <span class="absolute left-4 top-3 text-lg text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-1-md focus:outline-none" placeholder="Search">
                <button class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">Search</button>
            </div>


            {{-- yung icons --}}
            <div class="flex items-center space-x-4">


                {{-- listing a property button --}}
                <a href="paymentform" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div class="text-sx leading-3">Payment Form</div>
                </a>


                {{-- account button --}}
                <a href="user" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="text-sx leading-3">Account</div>
                </a>
            </div>
        </div>
    </header>


{{-- navbar (1) --}}
    <div class="bg-gray-700">
        <div class="container flex">

            {{-- categories --}}
            <div class="mr-5">
                <div class="px-8 py-4 hover:bg-primary flex items-center cursor-pointer relative group">
                    <span class="text-white">
                        <i class="fas fa-bars"></i>
                    </span>
                    <span class="capitalize ml-2 text-white">All Categories</span>

                    <div class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-solid hidden group-hover:block transition">

                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-map-location-dot w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Location</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-list w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Property Type</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-peso-sign w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Price</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-bed w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Bedrooms</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-calendar-days w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Short Term</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-bath w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Bathrooms</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-ruler-combined w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Floor Area</span>
                        </a>


                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-person-shelter w-5 h-5 object-contain"></i>
                            <span class="ml-6 text-gray-600 text-sm">Amenities</span>
                        </a>
                    </div>
                </div>
            </div>
            {{-- end of categories --}}

            {{-- navbar links --}}
            <div class="flex items-center justify-between flex-grow pl-12">
                <div class="flex items-center space-x-6 capitalize">
                    <a href="index" class="text-gray-200 hover:underline hover:text-white transition">Home</a>
                    <a href="rentals" class="text-gray-200 hover:underline hover:text-white transition">Rent</a>
                    <a href="aboutus" class="text-gray-200 hover:underline hover:text-white transition">About Us</a>
                </div>
                {{-- login and register --}}
                <a href="login" class="text-gray-200 hover:underline hover:text-white transition">Login/Register</a>
                {{-- end of login and register --}}
            </div>
            {{-- end of navbar links --}}
        </div>
    </div>
{{-- end of navbar --}}

{{-- account wrapper --}}
   <div class="container p-6 bg-white">
        <div class="container pt-4 pb-4 mx-5" >
            <div class="flex items-center">
                <img src="https://www.svgrepo.com/show/507442/user-circle.svg" class="w-40 mr-10" alt="">
                <h3 class="text-xl font-semibold">
                    Tenant Doe
                </h3>
            </div>
        </div>

        <div class="container gap-6 border-t pt-4 pb-16 items-start">

            {{-- <div class=" bg-white px-4 pb-2 overflow-hidden">
                <div class="mr-14">
                    <h3 class="text-xl font-semibold">
                        Rentals List
                    </h3>
                </div>

                <div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg">
                    <table class="table-auto w-full border-transparent">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 20%;">Photo</th>
                                <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Place Name</th>
                                <th class="py-2 px-3 text-gray-800 border-b border-gray-400" style="width: 15%;">Update</th>
                                <th class="py-2 px-3 text-gray-800 border-b border-gray-400" style="width: 15%;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;"><img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/9c8e653dc6d133.webp" alt="Property Photo 1"></td>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">4BR Fully Furnished House for lease in McKinley Hills Subdivision, Taguig</td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;"><button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;"><button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold"><i class="fa-solid fa-x"></i></button></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;"><img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/d81cc540022e2a.webp" alt="Property Photo 2"></td>
                                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">For Rent: 2 Storey House and Lot at M Residences, Taguig City</td>
                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;"><button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold"><i class="fa-solid fa-pen-to-square"></i></button></td>

                                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;"><button class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold"><i class="fa-solid fa-x"></i></button></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

            </div> --}}

            {{-- <div class=" bg-white px-4 pb-2 overflow-hidden ">
                <div class="mr-14 flex items-center">
                    <h3 class="text-xl mt-10 font-semibold">
                        Reviews and Feedback
                    </h3>
                </div>
            </div> --}}

            <div class="container mx-auto px-4 py-8">
                <h2 class="text-md font-semibold mb-4">Tenant Profile</h2>
                <div class="bg-white p-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Personal Information</h3>
                            <table class="w-full">
                                <tr>
                                    <td class="font-semibold">Name:</td>
                                    <td>John Doe</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Email:</td>
                                    <td>johndoe@example.com</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Phone:</td>
                                    <td>+1234567890</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
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
                            <th class="w-2/6 px-6 py-2 text-center">Property Name</th>
                            <th class="w-1/6 px-6 py-2 text-center">Landlord</th>
                            <th class="w-1/6 px-6 py-2 text-center">Download</th>
                            <th class="w-1/6 px-6 py-2 text-center">Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <tr class="border-b">
                            <td class="w-2/6 px-6 py-2 whitespace-normal">For Rent McKinley West House in Fort Bonifacio, Taguig City near McKinley Hill</td>
                            <td class="w-1/6 px-6 py-2 whitespace-normal text-center">John Doe</td>
                            <td class="w-1/6 px-6 py-2 text-center">
                                <a href="example.docx" download class="text-red-500 hover:underline text-md">Download</a>
                            </td>
                            <td class="w-1/6 px-6 py-2 text-center">
                                <label for="pdf-upload" class="text-red-500 hover:underline cursor-pointer text-md">Upload</label>
                                <input type="file" id="pdf-upload" class="hidden" accept=".pdf">
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>



            {{-- <div class="bg-white px-4 pb-2 overflow-hidden">
                <div class="mr-14 flex items-center">
                    <h3 class="text-xl mt-10 font-semibold">
                        Tenants Table
                    </h3>
                </div>
            </div> --}}

            {{-- <div class="container border rounded-md bg-white py-4 mt-4 overflow-hidden">
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
            </div> --}}

        </div>
   </div>
{{-- account wrapper --}}

{{-- Footer --}}
<footer class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grdi-cols-3">

        <div class="cons-span-1 space-y-8">
            <img src="https://www.svgrepo.com/show/272028/houses-home.svg" alt="homelogo" class="w-16">
            <p class="text-gray-500">
                What's up madlang people!!!
            </p>

            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
        </div>

        <div class="cons-span-2 grid grid-cols-2 gap-8">

        </div>

    </div>
</footer>
{{-- end of Footer --}}

</body>
</html>
