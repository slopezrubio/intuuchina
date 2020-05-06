<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    const ELEMENTS_PER_PAGE = 9;
    const PAGINATION_SCOPE = 4;

    /**
     * Retrieved all the job offers or just the ones that
     * matches the given filter.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $filter = null)
    {
        if ($filter !== null) {
            return $this->filter($filter, $request->ajax());
        }

        $offers = Offer::orderBy('created_at','DESC')->paginate(self::ELEMENTS_PER_PAGE);
        $offers->onEachSide = self::PAGINATION_SCOPE / 2;

        return view('pages/offers', compact('offers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        $offers = Offer::orderBy('created_at','DESC')->paginate(self::ELEMENTS_PER_PAGE);

        return view('pages/admin/offers', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.new-offer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255|string',
            'duration' => 'required|string',
            'description' => 'max:30000',
            'picture' => 'mimes:jpg,jpeg,bmp,png',
        ]);

        Offer::create([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'industry' => $request->get('industry'),
            'duration' => $request->get('duration'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('admin.offers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        return view('pages/admin/offer', [
            'offer' => Offer::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'duration' => 'required|string',
            'description' => 'max:30000',
            'picture' => 'mimes:jpg,jpeg,bmp,png',
        ]);

        Offer::find($id)->setChanges($request)->save();

        return redirect()->route('admin.offers');
    }

    /*
     * Sets all the modified data of the offer send by the user through the form.
     *
     * @param  \App\Offer  $request
     * @param  array $attributes
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function setUpdatedAttributesToOffer(Offer $offer, array $attributes, Request $request) {
        $updated = false;

        foreach ($attributes as $key => $value) {
            if ($key !== '_token') {
                if ($key === 'picture') {
                    $offer->destroyThumbnail();
                    $offer->saveThumbnail();
                    if (!$updated) {
                        $updated = true;
                    }
                } else {
                    if ($offer[$key] != $attributes[$key]) {
                        $offer[$key] = $attributes[$key];
                        if (!$updated) {
                            $updated = true;
                        }
                    }
                }
            }
        };
        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->destroyAssociatedFiles($id);

        Offer::destroy($id);

        return redirect()->route('admin.offers');
    }

    /*
     * Select all the offers that matches with the name of the industry passed as an argument
     * and send the partial view that comprises just the list of offers.
     */
    public function filter($filter, $ajax) {
        $offers = $filter !== 'all'
                ? Offer::where('industry', $filter)->orderBy('created_at', 'DESC')->paginate(self::ELEMENTS_PER_PAGE)
                : Offer::orderBy('created_at', 'DESC')->paginate(self::ELEMENTS_PER_PAGE);

        $offers->onEachSide = self::PAGINATION_SCOPE / 2;

        if ($ajax) {
            return response()->json(view('components.cards-list', compact('offers'))->render());
        }

        return view('pages/offers', compact('offers'));
    }

    /*
     * Check if there is already a file in the given path. If the opposite occur it store
     * the file.
     */
    public function uploadFile(Request $request) {
        if ($request->file('picture') !== null) {
            $filename = $this->generateFileName($request);
            $request->file('picture')->storeAs('public/images', $filename);
            return $filename;
        }

        // Return the picture default name
        $filename = 'generic_' . $request->get('industry') . '_picture.jpg';
        return $filename;
    }

    public function generateFileName($request) {
        if (method_exists($request, 'get')) {
            return $request->get('location') . '_' . $request->get('industry') . '_' . Carbon::now()->micro . '.' . $request->file('picture')->getClientOriginalExtension();
        }
    }

    public function destroyAssociatedFiles($id) {
        $offer = Offer::find($id);

        if (!preg_match('/generic/', $offer->picture)) {
            Storage::delete('public/images/' . $offer->picture);
        }

        return $this;
    }

    /*
     * Select the offer that matches the 'id' passed as a parameter.
     *
     * @param string $id
     */
    public function single($id) {
        return view('pages.job-description', [
            'offer' => Offer::find($id),
            'testimonials' => Testimonial::getFromDistinctUsers(Testimonial::MAX_NUMBER_OF_TESTIMONIALS)
        ]);
    }
}
