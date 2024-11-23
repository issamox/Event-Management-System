<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::query();

        // Sorting logic
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by'); // 'date' or 'location'
            $order = $request->input('order', 'asc'); // 'asc' or 'desc', default to 'asc'

            if (in_array($sortBy, ['date', 'location']) && in_array($order, ['asc', 'desc'])) {
                $events->orderBy($sortBy, $order);
            }
        }


        $events = $events->get();

        return view('events.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {

        Event::create($request->validated());

        return redirect()->route('events.index')->with('success', 'Event created successfully');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {

        $event->update($request->validated());

        return redirect()->route('events.index')->with('success', 'Event updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');

    }
}
