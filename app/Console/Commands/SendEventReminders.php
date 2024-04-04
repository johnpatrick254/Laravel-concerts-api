<?php

namespace App\Console\Commands;

use App\Http\Resources\AttendeeResource;
use App\Notifications\EventsNotification;
use Illuminate\Console\Command;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to all attendees that events are starting soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $events = \App\Models\Event::with('attendees.user')->whereBetween('start_time', [now(), now()->addDay()])->get();
        $events->each(
            fn ($event) => $event->attendees->each(
                fn ($attendee) => $attendee->user->notify(new EventsNotification($event))
            )
        );
    }
}
