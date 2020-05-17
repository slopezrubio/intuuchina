<?php

namespace App\Http\Controllers;

use App\CategoriesCollection;
use App\Category;
use App\Http\Middleware\StripFromUrl;
use App\Program;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(StripFromUrl::class)->only([
            'learn',
            'university'
        ]);
    }

    public function index() {

        return view('pages/home', [
            'testimonials' => Testimonial::getFromDistinctUsers(Testimonial::MAX_NUMBER_OF_TESTIMONIALS)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function learn(Request $request) {
        $category = Category::where('value', session('param'))->first();
        $slides = [];

        if ($category !== null) {
            $collection = new CategoriesCollection();
            $slides = $collection->slider($category->programs()->first()->studies, $category);
            if (!empty($slides)) {
                return view('pages/learn-chinese', [
                    'slides' => $slides,
                ]);
            }
        }

        return view('pages/learn-chinese');
    }

    public function university(Request $request) {
        $category = Category::where('value', session('param'))->first();
        $slides = [];

        if ($category !== null) {
            $collection = new CategoriesCollection();
            $slides = $collection->slider($category->programs()->first()->degrees, $category);
            if (!empty($slides)) {
                return view('pages/university', [
                   'slides' => $slides,
                ]);
            }
        }

//        if ($universitySelected !== null) {
//            $slider = $this->buildSlider('universities', $universitySelected);
//            if (!empty($slider)) {
//                return view('pages/university', compact('slider'));
//            }
//        }

        return view('pages/university');
    }

    public function applicationForm(Request $request) {
        session()->pull('preferences');

        $category_program = $request->get('program') !== null ? $request->get('program') : null;

        if ($category_program === null) {
            $category_program = Category::where('value', $request->get('category'))->first()->programs->first()->value;
        }

        session()->flash('preferences', [
            'program' => $category_program,
            $category_program => $request->get('category')
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
}
