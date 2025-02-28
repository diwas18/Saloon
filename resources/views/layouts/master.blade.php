<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sunshine Saloon</title>

    <link rel="shortcut icon" href="{{ asset('storage/images/logo.webp') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.alert')

    <nav class="shadow bg-white px-16 py-4 flex justify-between items-center fixed top-0 left-0 w-full opacity-90 z-50">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('storage/images/logo.webp') }}" alt="Logo" class="h-12">
        </a>

        <div class="flex gap-8 items-center">

            <!-- Home Link -->
            <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-black">Home</a>

            <!-- Services Link -->
            <a href="" class="text-gray-600 hover:text-black">Services</a>

            <!-- Latest Category -->
            @php
                $latestCategory = App\Models\Category::latest()->first();
                $categories = App\Models\Category::orderBy('name')->where('id', '!=', $latestCategory->id)->get();
            @endphp
            <a href="" class="text-gray-600 hover:text-black">{{ $latestCategory->name }}</a>



            <!-- Other Links -->
            <a href="" class="text-gray-600 hover:text-black">Gallery</a>
            <a href="#aboutus" class="text-gray-600 hover:text-black">About</a>
            <a href="" class="text-gray-600 hover:text-black">Our Team</a>
            <a href="{{route('bookings.create')}}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800">
                Book Now
            </a>

            @auth
                <div class="group relative">
                    <i class="ri-user-3-line text-2xl bg-gray-300 p-2 rounded-full cursor-pointer"></i>
                    <div class="absolute hidden group-hover:block top-10 right-0 bg-white shadow w-32">
                        <p class="block py-2 px-4 font-bold">{{ auth()->user()->name }}</p>

                        <a href="" class="block py-2 hover:bg-gray-200 p-4 rounded-lg">
                            <i class="ri-file-list-line"></i> My Bookings
                        </a>
                        <a href="" class="block py-2 hover:bg-gray-200 p-4 rounded-lg">
                            <i class="ri-profile-line"></i> My Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block py-2 hover:bg-gray-200 p-4 rounded-lg">
                                <i class="ri-logout-box-r-line"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-black">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 px-16 py-8">
        <div class="grid grid-cols-3 gap-8">
           <!-- About Section -->
            <div id="aboutus">

                <h2 class="text-white font-semibold text-lg">Sunshine Saloon</h2>
                <p class="mt-2 text-sm">
                    Premium hair styling services for men and women in a modern, comfortable environment.
                </p>
            </div>

            <!-- Hours Section -->
            <div>
                <h2 class="text-white font-semibold text-lg">Hours</h2>
                <p class="mt-2 text-sm">Sunday - Friday: 10am - 8pm</p>
                <p class="text-sm">Saturday: 9am - 6pm</p>
            </div>

            <!-- Contact Section -->
            <div>
                <h2 class="text-white font-semibold text-lg">Contact</h2>
                <p class="mt-2 text-sm">Hakim Chowk, Chitwan</p>
                <p class="text-sm">+977 9767628915</p>

                <p class="mt-2 text-sm">Naxal, Kathmandu</p>
                <p class="text-sm">+977 9848485482, +977 9808108477</p>

                <p class="mt-2 text-sm">Sanghai Street Jordan, Hongkong</p>
                <p class="text-sm">+852 27811744</p>

                <!-- Social Media Icons -->
                <div class="flex gap-4 mt-4">
                    <i class="ri-facebook-circle-fill text-xl"></i>
                    <i class="ri-instagram-line text-xl"></i>
                    <i class="ri-whatsapp-line text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-6 pt-4 text-center text-sm text-gray-400">
            © 2024 Sunshine Saloon. All rights reserved.
        </div>
    </footer>

</body>
</html>
