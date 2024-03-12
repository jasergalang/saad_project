{{-- navbar (1) --}}
<div class="">
    <div class="container flex">

         {{-- categories --}}
         {{-- <div class="mr-5">
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
         </div> --}}
         {{-- end of categories --}}

         {{-- navbar links --}}
         <div class="flex items-center justify-between flex-grow py-3 pl-96">
             <div class="flex items-center space-x-6 capitalize">
                 <a href="{{route('inquiriesform')}}" class="text-gray-200 hover:underline hover:text-white hover:scale-105 transition">Inquiries</a>
                 <a href="{{route('manageContract')}}" class="text-gray-200 hover:underline hover:text-white pl-12 hover:scale-105 transition">Contracts</a>
                 <a href="#" class="text-gray-200 hover:underline hover:text-white pl-12 hover:scale-105 transition">About us</a>
             </div>
             {{-- login and register --}}
             {{-- <a href="login" class="text-gray-200 hover:underline hover:text-white transition">Login/Register</a> --}}
             {{-- end of login and register --}}
         </div>
         {{-- end of navbar links --}}
    </div>
</div>
{{-- end of navbar --}}
