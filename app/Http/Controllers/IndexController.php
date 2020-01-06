<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\StripFromUrl;

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
