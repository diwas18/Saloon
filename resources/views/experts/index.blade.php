@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800">Experts</h1>
        <a href="{{ route('experts.create') }}" class="bg-gray-600 text-white px-4 py-2 rounded mt-4 inline-block">Add New Expert</a>

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
                            <th class="border border-gray-400 px-4 py-2">Name</th>
                            <th class="border border-gray-400 px-4 py-2">Specialization</th>
                            <th class="border border-gray-400 px-4 py-2">Experience (Years)</th>
                            <th class="border border-gray-400 px-4 py-2">Rating</th>
                            <th class="border border-gray-400 px-4 py-2">Availability</th>
                            <th class="border border-gray-400 px-4 py-2">Profile Picture</th>
                            <th class="border border-gray-400 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100">
                        @foreach ($experts as $expert)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $expert->name }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $expert->specialization }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $expert->experience_years }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $expert->rating ?? 'N/A' }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-gray-800">{{ $expert->availability }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-center">
                                    @if ($expert->profile_picture)
                                        <img src="{{ asset('storage/' . $expert->profile_picture) }}"
                                            alt="Profile Picture"
                                            class="w-12 h-12 rounded-full mx-auto">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2 text-center">
                                    <a href="{{ route('experts.edit', $expert->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    |
                                    <form action="{{ route('experts.destroy', $expert->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
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
