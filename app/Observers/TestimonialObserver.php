<?php

namespace App\Observers;

use App\Testimonial;

class TestimonialObserver
{
    /**
     * Handle the testimonial "created" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function created(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the testimonial "updated" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function updated(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the testimonial "deleted" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function deleted(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the testimonial "retrieved" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function retrieved(Testimonial $testimonial)
    {
        $testimonial->setQuotes();
    }

    /**
     * Handle the testimonial "restored" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function restored(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the testimonial "force deleted" event.
     *
     * @param  \App\Testimonial  $testimonial
     * @return void
     */
    public function forceDeleted(Testimonial $testimonial)
    {
        //
    }
}
