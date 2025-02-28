@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8 mt-12 max-w-screen-xl"> <!-- Make the container wide for full-page view -->
    <div class="flex justify-center items-center mb-10">
        <!-- Service Image -->
        <div class="w-full max-w-md">
            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                class="w-full h-96 object-cover object-center rounded-lg shadow-lg">
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Service Details -->
        <div class="flex-1">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $service->name }}</h1>
            <p class="text-lg text-gray-700 mb-6">{{ $service->description }}</p>

            <div class="space-y-4 text-lg text-gray-600">
                <p><strong>Duration:</strong> {{ $service->duration }} minutes</p>
                <p><strong>Price:</strong> ₹{{ number_format($service->price, 2) }}</p>
                <p><strong>Category:</strong> {{ $service->category->name ?? 'N/A' }}</p>
                <p><strong>Expert:</strong> {{ $service->expert->name ?? 'N/A' }}</p>
                <p><strong>Appointment Type:</strong> {{ ucfirst($service->appointment_type) }}</p>
            </div>

            <!-- Book Now Button -->
            <div class="mt-6">
                <a href="{{ route('bookings.create', ['service_id' => $service->id]) }}"
                    class="inline-block text-center bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-500 transition duration-300">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
