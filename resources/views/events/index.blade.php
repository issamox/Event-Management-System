<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create a new event button -->
            <div class="text-right mb-6">
                <a href="{{ route('events.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 transition-colors">
                    Create New Event
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Sorting Form -->
                    <form method="GET" action="{{ route('events.index') }}" class="mb-6">
                        <div class="flex justify-between items-center gap-4 px-4 py-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                            <div class="w-1/3">
                                <select name="sort_by" id="sort_by" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 dark:text-black dark:bg-gray-800">
                                    <option value="">Sort By:</option>
                                    <option value="date" {{ request('sort_by') === 'date' ? 'selected' : '' }}>Date</option>
                                    <option value="location" {{ request('sort_by') === 'location' ? 'selected' : '' }}>Location</option>
                                </select>
                            </div>

                            <div class="w-1/3">
                                <select name="order" id="order" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 dark:text-black dark:bg-gray-800">
                                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Asc</option>
                                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Desc</option>
                                </select>
                            </div>

                            <div class="w-1/3">
                                <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:ring-2 focus:ring-indigo-500">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Event Table -->
                    <div class="overflow-x-auto rounded-lg shadow-md bg-gray-50 dark:bg-gray-700">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Date</th>
                                <th class="py-3 px-4">Location</th>
                                <th class="py-3 px-4">RSVP Limit</th>
                                <th class="py-3 px-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($events as $event)
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-800">
                                    <td class="py-3 px-4">{{ $event->name }}</td>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i A') }}</td>
                                    <td class="py-3 px-4">{{ \Str::limit($event->location, 15) }}</td>
                                    <td class="py-3 px-4">{{ $event->rsvp_limit }}</td>
                                    <td class="py-3 px-4 flex space-x-3">
                                        <a href="{{ route('events.show', $event->id) }}" class="bg-[#e84393] text-white py-2 px-4 rounded hover:bg-pink-600 transition">RSVP</a>
                                        <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition">Edit</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $events->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
