@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8 mt-12"> <!-- Added mt-12 for top margin to avoid navbar overlap -->
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-6">Services</h1>

    <!-- Main service grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($services as $service)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out"> <!-- Added hover scale effect -->

                <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-48 object-cover object-center">


                <div class="p-6"> <!-- Increased padding for better spacing -->
                    <!-- Service Name -->
                    <h1 class="text-2xl font-bold text-center text-gray-900 mb-4">{{ $service->name }}</h1> <!-- Center-aligned and bold -->

                    <!-- Service Description -->
                    <p class="text-sm text-gray-700 mb-4">{{ $service->description }}</p>

                    <div class="mt-2 text-sm text-gray-600">
                        <p><strong>Duration:</strong> {{ $service->duration }} minutes</p>
                        <p><strong>Price:</strong> ₹{{ number_format($service->price, 2) }}</p>
                        <p><strong>Category:</strong> {{ $service->category->name ?? 'N/A' }}</p>
                        <p><strong>Expert:</strong> {{ $service->expert->name ?? 'N/A' }}</p>
                        <p><strong>Appointment Type:</strong> {{ ucfirst($service->appointment_type) }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('bookings.create', ['service_id' => $service->id]) }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-500">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Related services based on the category -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Related Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($relatedServices as $relatedService)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('serviceview', $relatedService->id) }}" class="block h-full"> <!-- Wrapping entire card in a clickable link -->
                        @if ($relatedService->image)
                            <img src="{{ asset('storage/' . $relatedService->image) }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-600">No Image</div>
                        @endif

                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $relatedService->name }}</h2>
                            <p class="text-sm text-gray-700 mb-4">{{ $relatedService->description }}</p>

                            <div class="mt-2 text-sm text-gray-600">
                                <p><strong>Duration:</strong> {{ $relatedService->duration }} minutes</p>
                                <p><strong>Price:</strong> ₹{{ number_format($relatedService->price, 2) }}</p>
                                <p><strong>Category:</strong> {{ $relatedService->category->name ?? 'N/A' }}</p>
                                <p><strong>Expert:</strong> {{ $relatedService->expert->name ?? 'N/A' }}</p>
                                <p><strong>Appointment Type:</strong> {{ ucfirst($relatedService->appointment_type) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
