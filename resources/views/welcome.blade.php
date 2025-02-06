@extends('layouts.master')

@section('content')

<section class="text-center py-16 bg-gradient-to-b from-pink-100 to-white mt-12">
    <h1 class="text-4xl font-bold text-gray-900">Your Beauty, Our Passion</h1>
    <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
        Experience premium hair styling services for both men and women in a modern, comfortable environment.
        Our expert stylists are here to help you look and feel your best.
    </p>
    <button class="mt-6 bg-gray-900 text-white px-6 py-2 rounded-md hover:bg-gray-700">
        Book Your Visit
    </button>
</section>

<section class="py-12">
    <h2 class="text-center text-2xl font-bold text-gray-900">Our Services</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-8">
        @foreach ($services as $service)
            <a href="{{ route('serviceview', $service->id) }}" class="transition-all transform hover:scale-105">
                <div class="hover:bg-gray-200">
                    <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-64 object-cover rounded-lg">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold">{{ $service->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="py-12">
    <h2 class="text-center text-2xl font-bold text-gray-900">Our Works</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-8">
        @foreach ($works as $work)
            <a href="{{ route('workview', $work->id) }}" class="transition-all transform hover:scale-105">
                <div>
                    <img src="{{ $work->photo1 ? asset('storage/' . $work->photo1) : 'https://via.placeholder.com/400x300' }}" class="w-full h-64 object-cover rounded-lg">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold">{{ $work->name }}</h3>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="py-12">
    <h2 class="text-center text-2xl font-bold text-gray-900">Our Branches</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-8">
        @foreach ($branches as $branch)
            <a href="{{route('branchview',$branch->id)}}" class="transition-all transform hover:scale-105">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $branch->image) }}"
                         alt="{{ $branch->name }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">{{ $branch->name }}</h3>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>


<section class="py-12 bg-gray-100">
    <h2 class="text-center text-2xl font-bold text-gray-900">Our Team</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-8 text-center">
        @foreach ($experts as $member)
            <a href="{{ route('expertview', $member->id) }}" class="transition-all transform hover:scale-105">
                <div>
                    <img src="{{ asset('storage/' . $member->profile_picture) }}" class="w-32 h-32 mx-auto rounded-full border-4 border-blue-500">
                    <h3 class="font-semibold mt-4">{{ $member->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $member->specialization }}</p>
                    <div class="mt-2">
                        @php
                            $fullStars = floor($member->rating);
                            $halfStar = ($member->rating - $fullStars) >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp

                        <span class="text-yellow-500">
                            @for ($i = 0; $i < $fullStars; $i++)
                                ★
                            @endfor
                            @if ($halfStar)
                                ☆
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <span class="text-gray-400">★</span>
                            @endfor
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>


@endsection
