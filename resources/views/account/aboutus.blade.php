@extends('layout.authlayout')

@section('content')
@include('layout.header')

@include('layout.nav')

{{-- banner (do we need this ?)--}}
<div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('https://images.pexels.com/photos/5407074/pexels-photo-5407074.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
    <div class="container">
        <h1 class="text-4xl text-white font-medium mb-4">
            RenEase
        </h1>
        <p class="text-xl text-white font-medium mb-4">
            Renting a place to stay is like unlocking a door to possibilities, <br>
            where every key moment becomes a chapter in the story of your life.
        </p>
        <div class="mt-12">
            <a href="#" class="bg-red-800 text-white px-8 py-3 font-medium rounded-md border border-red-800 hover:border-primary hover:bg-transparent hover:text-white">Rent Now</a>
        </div>
    </div>
</div>
{{-- end of banner --}}

{{-- q&a ? --}}
<div class="bg-white pt-16 pb-12 border-t border-gray-100">
<div class="container grid grdi-cols-1 py-4">
    <h3 class="text-black font-semibold text-xl py-5">House and Lot for Rent: A Smart Option Before Getting Your Forever Home</h3>
    <p class="text-gray-800 font-medium text-justify">
        The Philippine economy has been growing for more than ten years, and this trend is expected to continue.
        Some people now find it more sensible to rent a home due to the Philippines' increasing real estate property values.
        <br><br>
        Additionally, vacant lots are getting harder to come by, especially in metropolitan regions like Metro Manila.
        The trend is leading to an increase in the value of houses and lots.
        Even if price increases are a drawback, those looking for real estate might want to think about renting a home and land.
        Renters in the future will profit from owning a property without having to commit to anything financially or otherwise.
    </p>

    <h3 class="text-black font-semibold text-xl py-5">Average Rental Prices for Houses and Lots for Rent</h3>
    <p class="text-gray-800 font-medium text-justify">
        The most affordable house and lot for rent in the Philippines cost Php 4,000 monthly.
        If you are after luxury living in a progressive city, expect that the fee of a house and lot for rent can reach up to Php 2.6 million monthly.
    </p>

    <h3 class="text-black font-semibold text-xl py-5">Why Rent a House and Lot</h3>
    <p class="text-gray-800 font-medium text-justify">
        Renting a house and lot is one option to get well-built residences without having to pay a lot of money upfront.
        Renters can live in excellent residential projects that are close to institutions and establishments that provide a variety of goods, services, entertainment, and conveniences.
        <br><br>
        There are also rent-to-own residences and lots available.
        These are good for people who wish to buy a house but don't have the funds on hand to pay the entire price right now.
        Most property owners want a leasing period of at least six months to one year for people interested in renting to acquire a house and lot.
    </p>
</div>
</div>
{{-- end of q&a ? --}}

{{--  --}}
<div class="container mx-auto py-8">
<!-- Company Story Section -->
<section class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Company Story</h2>
    <p class="text-gray-700">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan molestie felis, eget rutrum
        nisi vehicula quis. Phasellus at magna nec massa dapibus feugiat.
    </p>
</section>

<!-- Team Member Section -->
<section class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Team Member</h2>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-2">John Doe</h3>
                <p class="text-gray-700">Co-founder & CEO</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-2">Jane Doe</h3>
                <p class="text-gray-700">Co-founder & CEO</p>
            </div>
        </div>
        <!-- Add more team members as needed -->
    </div>
</section>

<!-- Product or Service Information Section -->
<section class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Product or Service Information</h2>
    <p class="text-gray-700">
        Our company offers a wide range of products/services to meet the needs of our customers. Lorem ipsum
        dolor sit amet, consectetur adipiscing elit. Duis accumsan molestie felis, eget rutrum nisi vehicula
        quis.
    </p>
</section>

<!-- Updates or News Section -->
<section>
    <h2 class="text-2xl font-bold mb-4">Updates or News</h2>
    <div class="max-w-lg">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
            <h3 class="text-xl font-bold mb-2">New Product Launch</h3>
            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan
                molestie felis, eget rutrum nisi vehicula quis.</p>
        </div>
        <!-- Add more updates or news items as needed -->
    </div>
</section>
</div>

@include('layout.footer');
@endsection
