@extends('layouts.master')

@section('content')
<section class="py-12 max-w-4xl mx-auto mt-32"> <!-- Increased margin-top to prevent overlap -->
    <h2 class="text-center text-2xl font-bold text-gray-900">New Booking</h2>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">User</label>
                <select name="user_id" class="w-full border rounded p-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Branch</label>
                <select name="branch_id" class="w-full border rounded p-2">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Expert</label>
                <select name="expert_id" class="w-full border rounded p-2">
                    <option value="">No Expert</option>
                    @foreach($experts as $expert)
                        <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Booking Date</label>
                <input type="date" name="booking_date" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Booking Time</label>
                <select name="booking_time" class="w-full border rounded p-2">
                    @foreach($timeSlots as $slot)
                        <option value="{{ $slot }}">{{ $slot }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-center space-x-4 mt-6">
                <a href="{{ route('welcome') }}" class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600 transform hover:scale-105 transition-all duration-300">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                    Create Booking
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
