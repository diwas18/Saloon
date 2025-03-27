@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Add New Work</h1>

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

        <form action="{{ route('works.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Work Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Enter work name" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Upload Photos</label>
                <input type="file" name="photo1" class="w-full px-4 py-2 border rounded-lg mt-1" required>
                <input type="file" name="photo2" class="w-full px-4 py-2 border rounded-lg mt-1">
                <input type="file" name="photo3" class="w-full px-4 py-2 border rounded-lg mt-1">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Enter description" required></textarea>
            </div>

            <div class="mb-4">
                <label for="expert_id" class="block text-gray-700 font-semibold">Select Expert</label>
                <select name="expert_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    <option value="">-- Choose Expert --</option>
                    @foreach($experts as $expert)
                        <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="completed_at" class="block text-gray-700 font-semibold">Completed At</label>
                <input type="datetime-local" name="completed_at" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                Save Work
            </button>
            <a href="{{ route('works.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transform hover:scale-105 transition-all duration-300">
                 Cancel
            </a>


        </form>
    </div>
@endsection
