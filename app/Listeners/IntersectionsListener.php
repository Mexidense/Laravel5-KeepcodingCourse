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
        $avg6CrossesAvg70 = abs($stockValues->avg_70 - $stockValues->avg_6) <= $margin;
        $avg6BiggerAvg70 = $stockValues->avg_6 >= $stockValues->avg_70;
        $avg70BiggerAvg200 = $stockValues->avg_70 >= $stockValues->avg_200;

        if ($avg6CrossesAvg70) {
            if ($avg6BiggerAvg70) {
                if ($avg70BiggerAvg200) {
                    $message = config('larastock.uptrend_message');
                } else {
                    $message = config('larastock.downtrend_correction_message');
                }
            } else {
               if ($avg70BiggerAvg200) {
                   $message = config('larastock.uptrend_correction_message');
               } else {
                   $message = config('larastock.downtrend_message');
               }
            }
        }
        echo $message;
    }
}
