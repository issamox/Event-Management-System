<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        $events = $events->paginate(10);

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

    public function show(Event $event){
        return view('events.show', compact('event'));
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

    // POST /events/{id}/rsvp
    public function rsvp(Event $event)
    {
        $user = Auth::user();

        // Check if RSVP limit is reached
        if ($event->reservations()->count() >= $event->rsvp_limit) {
            return redirect()->route('events.show', $event->id)->with('error', 'RSVP limit reached for this event.');
        }

        // Check if the user has already reservation
        if ($event->reservations()->where('user_id', $user->id)->exists()) {
            return redirect()->route('events.show', $event->id)->with('error', 'You have already a reservation for this event.');
        }


        // Add RSVP entry
        $event->reservations()->attach(auth()->id());

        return redirect()->route('events.show', $event->id)->with('success', 'RSVP successful! We look forward to seeing you at the event.');
    }

}
