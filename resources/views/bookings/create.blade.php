@extends('layouts.master')

@section('content')
<section class="py-12 max-w-4xl mx-auto mt-32">
    <h2 class="text-center text-3xl font-semibold text-gray-900 mb-8">New Booking</h2>
    <div class="bg-white shadow-xl rounded-xl p-8">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Full Name</label>
                <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Contact Number</label>
                <input type="text" name="contact_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Branch</label>
                <select name="branch_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Service</label>
                <select name="service_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Expert</label>
                <select name="expert_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">No Expert</option>
                    @foreach($experts as $expert)
                        <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Booking Date</label>
                <input type="date" name="booking_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-800 mb-2">Booking Time</label>
                <select name="booking_time" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    @foreach($timeSlots as $slot)
                        <option value="{{ $slot }}">{{ $slot }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('welcome') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-600 transform hover:scale-105 transition-all duration-300">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
