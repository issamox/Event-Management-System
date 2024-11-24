<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Create a new event button -->
                    @if(auth()->user()->role === 'admin')
                        <div class="text-right mb-6">
                            <x-primary-link href="{{ route('events.create') }}" classes="mt-4">
                                + Create New Event
                            </x-primary-link>
                        </div>
                    @endif
                    <!-- Sorting and Filter Form -->
                    <form method="GET" action="{{ route('events.index') }}" class="mb-8">
                        <div class="flex justify-between items-center gap-4 px-4 py-4 bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md">
                            <div class="w-1/3">
                                <select name="sort_by" id="sort_by" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                                    <option value="">Sort By:</option>
                                    <option value="date" {{ request('sort_by') === 'date' ? 'selected' : '' }}>Date</option>
                                    <option value="location" {{ request('sort_by') === 'location' ? 'selected' : '' }}>Location</option>
                                </select>
                            </div>

                            <div class="w-1/3">
                                <select name="order" id="order" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Asc</option>
                                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Desc</option>
                                </select>
                            </div>

                            <div class="w-1/3">
                                <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600 transition-colors focus:ring-2 focus:ring-indigo-500">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Event Table -->
                    <div class="overflow-x-auto rounded-xl shadow-lg bg-gray-50 dark:bg-gray-700">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="bg-blue-600 text-white rounded-t-xl">
                            <tr>
                                <th class="py-3 px-4 text-center">Name</th>
                                <th class="py-3 px-4 text-center">Date</th>
                                <th class="py-3 px-4 text-center">Location</th>
                                <th class="py-3 px-4 text-center">RSVP Limit</th>
                                <th class="py-3 px-4 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($events as $event)
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-800">
                                    <td class="py-3 px-4">{{ $event->name }}</td>
                                    <td class="py-3 px-4 text-center">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i A') }}</td>
                                    <td class="py-3 px-4 text-center">{{ \Str::limit($event->location, 15) }}</td>
                                    <td class="py-3 px-4 text-center">{{ $event->rsvp_limit }}</td>
                                    <td class="py-3 px-4 flex justify-center space-x-3">
                                        <a href="{{ route('events.show', $event->id) }}" class="bg-[#e84393] text-white py-2 px-4 rounded-full hover:bg-pink-600 transition transform hover:scale-105">
                                            RSVP
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded-full hover:bg-yellow-600 transition shadow-md">
                                                ✏️
                                            </a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-full hover:bg-red-600 transition shadow-md">
                                                    🗑️
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $events->links('pagination::tailwind') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
