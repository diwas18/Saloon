@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Edit Work</h1>
            <a href="{{ route('works.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transform hover:scale-105 transition-all duration-300">
                ⬅ Back to Works
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-3 rounded mb-4">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('works.update', $work->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Work Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ old('name', $work->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Upload Photos</label>
                <input type="file" name="photo1" class="w-full px-4 py-2 border rounded-lg mt-1">
                @if($work->photo1)
                    <img src="{{ asset('storage/' . $work->photo1) }}" class="w-16 h-16 object-cover rounded mt-2">
                @endif

                <input type="file" name="photo2" class="w-full px-4 py-2 border rounded-lg mt-1">
                @if($work->photo2)
                    <img src="{{ asset('storage/' . $work->photo2) }}" class="w-16 h-16 object-cover rounded mt-2">
                @endif

                <input type="file" name="photo3" class="w-full px-4 py-2 border rounded-lg mt-1">
                @if($work->photo3)
                    <img src="{{ asset('storage/' . $work->photo3) }}" class="w-16 h-16 object-cover rounded mt-2">
                @endif
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>{{ old('description', $work->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="expert_id" class="block text-gray-700 font-semibold">Select Expert</label>
                <select name="expert_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    <option value="">-- Choose Expert --</option>
                    @foreach($experts as $expert)
                        <option value="{{ $expert->id }}" {{ $work->expert_id == $expert->id ? 'selected' : '' }}>{{ $expert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="completed_at" class="block text-gray-700 font-semibold">Completed At</label>
                <input type="datetime-local" name="completed_at" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ old('completed_at', $work->completed_at ? $work->completed_at->format('Y-m-d\TH:i') : '') }}">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                ✅ Update Work
            </button>
        </form>
    </div>
@endsection
