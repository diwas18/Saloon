@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800">Bookings</h1>

        <div class="mt-6">
            @if (session('success'))
                <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-300 text-gray-700">
                        <tr>
                            <th class="border border-gray-400 px-4 py-2">ID</th>
                            <th class="border border-gray-400 px-4 py-2">User</th>
                            <th class="border border-gray-400 px-4 py-2">Branch</th>
                            <th class="border border-gray-400 px-4 py-2">Expert</th>
                            <th class="border border-gray-400 px-4 py-2">Booking Date</th>
                            <th class="border border-gray-400 px-4 py-2">Booking Time</th>
                            <th class="border border-gray-400 px-4 py-2">Status</th>
                            <th class="border border-gray-400 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100">
                        @foreach($bookings as $booking)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->id }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->user->name }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->branch->name }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->expert ? $booking->expert->name : 'N/A' }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->booking_date }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $booking->booking_time }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">
                                    <span class="bg-{{ $booking->status == 'pending' ? 'yellow-300' : ($booking->status == 'confirmed' ? 'green-300' : 'gray-300') }} text-gray-800 px-2 py-1 rounded">{{ ucfirst($booking->status) }}</span>
                                </td>
                                <td class="border border-gray-400 px-4 py-2 text-center">
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    |
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
