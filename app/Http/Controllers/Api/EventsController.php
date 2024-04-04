<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Event::class,'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return EventResource::collection(Event::with('user')->with('attendees')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $event = Event::Create([
            ...$request->validate([
                "name" => "required|string",
                "start_time" => "required|date",
                "end_time" => "required|date|after:start_time",
                "description" => "nullable|string"
            ]),
            "user_id" => request()->user()->id
        ]);
        $event->load('user');
        $event->load('attendees');
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        $event->load('user');
        $event->load('attendees');
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
        $event->update([
            ...$request->validate([
                'name' => 'nullable|string',
                "description" => "nullable|string",
                "start_time" => "nullable|date",
                "end_time" => "nullable|date",
            ])
        ]);
        $event->load('user');
        $event->load('attendees');
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();

        return response()->json([
            "message" => "Event deleted successfully"
        ]);
    }
}
