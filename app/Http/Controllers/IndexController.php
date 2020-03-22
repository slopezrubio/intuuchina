<?php

namespace App\Http\Controllers;

use App\Http\Middleware\StripFromUrl;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    const MAX_NUMBER_OF_TESTIMONIALS = 3;

    public function __construct()
    {
        $this->middleware(StripFromUrl::class)->only([
            'learn',
            'university'
        ]);
    }

    public function index() {

        return view('pages/home', [
            'testimonials' => Testimonial::getFromDistinctUsers(self::MAX_NUMBER_OF_TESTIMONIALS)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function learn(Request $request) {
        $courseSelected = session('param');

        if ($courseSelected !== null) {
            $slider = $this->buildSlider('courses', $courseSelected);
            if (!empty($slider)) {
                return view('pages/learn-chinese', compact('slider'));
            }
        }

        return view('pages/learn-chinese');
    }

    public function university(Request $request) {
        $universitySelected = session('param');

        if ($universitySelected !== null) {
            $slider = $this->buildSlider('universities', $universitySelected);
            if (!empty($slider)) {
                return view('pages/university', compact('slider'));
            }
        }

        return view('pages/university');
    }

    public function applicationForm(Request $request) {
        session()->pull('preferences');
        session()->flash('preferences', [
            'program' => $request->get('program') !== 'industry' ? $request->get('program') : 'inter_relocat',
            $request->get('product') => $request->get($request->get('program'))
        ]);

        return redirect()->route('register');
    }

    /**
     * Creates the array is going to be flashed into the session by the @see applicationForm method.
     *
     * @param array $parameters
     * @return array
     */
    private function setPreferences(Array $preferences) {
        $found = false;
        $options = [];
        while ($preference = current($preferences) && $found !== true) {
            for ($y = 0; $y < count(__('content.programs')) && $found !== true; $y++) {
                $pattern = __('content.programs')[$y];
                if ($pattern ===  key($preferences)) {
                    $found = true;
                    $options[key($preferences)] = current($preferences);
                }
            }
            next($preferences);
        }

        $options['program'] = $parameters['program'];
        return $options;
    }

    private function buildSlider($items, $selected) {
        $slider = [];
        ${$items} = __('content.' . $items);
        $current = array_key_first( __('content.' . $items));

        while ($current !== $selected) {
            next(${$items});
            $current = key(${$items});
            if ($current === $selected) {
                $slider['previous'] = prev(${$items});
                $slider['current'] = next(${$items});
                $slider['next'] = next(${$items});
            }
        }

        return $slider;
    }
}
