@extends('layouts.app')

@section('content')
    <a href="{{ route('events.index') }}" class="my-3 underline decoration-1 text-blue-500 font-bold inline-block text-xl py-2  rounded ">Back</a>

    <div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-center text-2xl font-bold">Event List</h1>

        <!--  create a new event -->
        <div class="text-right">
            <a href="{{ route('events.create') }}" class="bg-green-500 text-white my-5 px-4 py-2 inline-block rounded hover:bg-yellow-600">Create New Event</a>
        </div>

        <!-- Sorting Form -->
        <form method="GET" action="{{ route('events.index') }}"  class="mb-4">
            <div class="flex justify-between items-center gap-12 py-6 px-4 bg-gray-200">

                <div class="w-full">
                    <select name="sort_by" id="sort_by" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Sort By:</option>
                        <option value="date" {{ request('sort_by') === 'date' ? 'selected' : '' }}>Date</option>
                        <option value="location" {{ request('sort_by') === 'location' ? 'selected' : '' }}>Location</option>
                    </select>
                </div>

                <div class="w-full">
                    <select name="order" id="order" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Asc</option>
                        <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Desc</option>
                    </select>
                </div>


                <!-- Submit Button -->
                <div class="w-full">
                    <button type="submit" class="w-full bg-indigo-400 text-white py-2 px-4 rounded ml-2 hover:bg-indigo-600">Filter</button>
                </div>
            </div>

        </form>


        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
            <tr>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Description</th>
                <th class="py-3 px-6 text-left">Date</th>
                <th class="py-3 px-6 text-left">Location</th>
                <th class="py-3 px-6 text-left">RSVP limit</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($events as $event)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $event->name }}</td>
                    <td class="py-3 px-6">{{\Str::limit($event->description, 50) }}</td>
                    <td class="py-3 px-6">{{ $event->date }}</td>
                    <td class="py-3 px-6">{{ $event->location }}</td>
                    <td class="py-3 px-6">{{ $event->rsvp_limit }}</td>
                    <td class="py-3 px-6">
                        <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded ml-2 hover:bg-red-600">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
