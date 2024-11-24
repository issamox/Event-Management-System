<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Event') }}: {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Back to Users List -->
                    <a href="{{ route('events.index') }}" class="mb-6 inline-block text-sm text-indigo-600 hover:text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Event List
                    </a>
                    <!-- Event Update Form -->
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <!-- Event Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white/80">Event Name</label>
                                <input type="text" id="name" name="name" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-black dark:bg-gray-800" placeholder="Enter Event name" required value="{{ old('name', $event->name) }}">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Date -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-white/80">Event Date</label>
                                <input type="datetime-local" id="date" name="date" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-black dark:bg-gray-800" required value="{{ old('date', $event->date) }}">
                                @error('date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <!-- Event Location -->
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-white/80">Event Location</label>
                            <input type="text" id="location" name="location" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-black dark:bg-gray-800" placeholder="Enter Event location" required value="{{ old('location', $event->location) }}">
                            @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <!-- Event Description -->
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-white/80">Description</label>
                            <textarea id="description" name="description" rows="4" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-black dark:bg-gray-800" placeholder="Enter event description" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <!-- RSVP Limit -->
                            <label for="rsvp_limit" class="block text-sm font-medium text-gray-700 dark:text-white/80">RSVP Limit</label>
                            <input type="number" id="rsvp_limit" name="rsvp_limit" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-black dark:bg-gray-800" placeholder="Enter Event RSVP limit" required value="{{ old('rsvp_limit', $event->rsvp_limit) }}">
                            @error('rsvp_limit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
