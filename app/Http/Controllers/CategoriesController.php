<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getInfoBox(Request $request) {
        $category = Category::where('value', $request->get('category'))->first();

        return view('components.c-price-box', [
            'price_box' => __('component.c-price-box.' . $category->value),
            'price' => $category->fee->amount,
        ]);
    }
}
