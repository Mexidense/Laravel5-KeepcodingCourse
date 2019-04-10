<?php

namespace App\Listeners;

use App\Events\Intersections;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IntersectionsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Intersections  $event
     * @return void
     */
    public function handle(Intersections $event)
    {
        //
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Intersections',
            'App\Listeners\IntersectionsListener@onNewHistoricalValue'
            );
    }

    public function onNewHistoricalValue($stockValues)
    {
        $margin = config('larastock.intersection_margin');
        abs($stockValues->avg_70 - $stockValues->avg_6) <= $margin;
    }
}
