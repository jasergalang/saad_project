<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>FindFlat</title>

   <!-- Link to your compiled CSS file -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

   <!-- Include Tailwind CSS from CDN -->
   <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

   <!-- Include Font Awesome from CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="">
    <div class="min-h-screen relative" style="background-image: url('https://images.pexels.com/photos/17425758/pexels-photo-17425758/free-photo-of-red-facade-of-urban-house.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); background-position: center; background-size: cover; padding: 2rem 0 5rem;">

        <div class="ml-36 text-white mt-44 max-w-xl">
            <h1 class="text-6xl font-semibold leading-normal">Finding<br>place just<span class="font-light"> got easier</span></h1>
            <p>Renting a place to stay is like unlocking a door to possibilities,
                where every key moment becomes a chapter in the story of your life.</p>

            <div class="mt-10">
                <a href="{{route('login')}}" class="bg-red-500 rounded-3xl py-3 px-8 font-medium inline-block mr-4 hover:bg-transparent hover:border-red-500 hover:text-white duration-300 hover:border border border-transparent">
                    Get Started
                </a>
            </div>
        </div>

        <img src="https://www.svgrepo.com/show/272028/houses-home.svg" class="w-full xl:w-1/3 xl:absolute bottom-56  right-36 cursor-pointer">

    </div>
</body>
</html>
