<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $fee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        Fee::destroy($testimonial->id);

        //TODO
        //return redirect()->route('admin.testimonials');
    }
}
