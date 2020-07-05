<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
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

    public function getResource($category) {
        return new CategoryResource(Category::where('value', $category)->first());
    }
}
