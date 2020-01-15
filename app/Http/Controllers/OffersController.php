<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Offer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    const ELEMENTS_PER_PAGE = 3;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | JsonResponse
     */
    public function index(Request $request)
    {
        /*
         * Realiza la consulta a la base de datos para seleccionar todos los datos ordenados
         * por la fecha de creación.
         */
        $offers = Offer::orderBy('created_at','DESC')->paginate(self::ELEMENTS_PER_PAGE);
        $this->setDaysRenewed($offers);
        $isAjax = $request->ajax();

        if ($isAjax) {
            if ($request->get('isNewFilter')) {
                $isNewFilter = $request->get('isNewFilter');
                return response()->json(view('partials/_offers-list', compact('offers', 'isAjax', 'isNewFilter'))->render());
            }

            return response()->json(view('partials/_offers-list', compact('offers', 'isAjax'))->render());
        }

        return view('pages/offers', compact('offers', 'isAjax'));
    }

    /**
     * Sets a new field for each offer the time consummated since the offer was
     * updated for the last time. This information will be shown in the view
     * as the date of the offer.
     *
     * @param $offers
     * @return mixed
     */
    public function setDaysRenewed($offers) {
        if (count($offers) > 0) {
            foreach ($offers as $offer) {
                $offer->gone_by = Carbon::parse($offer->created_at)->diffForHumans(Carbon::now());
            }
        }

        return $offers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $offers = Offer::orderBy('created_at','DESC')->paginate(self::ELEMENTS_PER_PAGE);
        $this->setDaysRenewed($offers);

        return view('pages/admin/offers', compact('offers', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255|string',
            'location' => 'required|string',
            'industry' => 'required|string',
            'duration' => 'required|string',
            'description' => 'max:4000',
            'picture' => 'mimes:jpg,jpeg,bmp,png',
        ]);

        Offer::create([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'industry' => $request->get('industry'),
            'duration' => $request->get('duration'),
            'description' => $request->get('description'),
            'picture' => $this->uploadFile($request),
        ]);

        return redirect()->route('admin.offers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $offer = Offer::find($id);

        return view('pages/admin/offer', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $offer = Offer::find($id);
        $update = $this->setUpdatedAttributesToOffer($offer, $request->all(), $request);
        $offer->renewUpdateAt($update);
        $offer->save();

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
                    $this->deleteUploadedFileAssociatedWithOffer($offer->id);
                    $offer[$key] = $this->uploadFile($request);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteUploadedFileAssociatedWithOffer($id);
        Offer::destroy($id);

        return redirect()->route('admin.offers');
    }

    /*
     * Select all the offers that matches with the name of the industry passed as an argument
     * and send the partial view that comprises just the list of offers.
     */
    public function filterBy(Request $request, $filter) {
        $isAjax = $request->ajax();
        $isNewFilter = $request->get('isNewFilter');

        $offers = Offer::where('industry', $filter)->orderBy('created_at', 'DESC')->paginate(self::ELEMENTS_PER_PAGE);
        $this->setDaysRenewed($offers);

        if ($isNewFilter) {
            return response()->json(view('partials/_offers-list', compact('offers', 'filter', 'isNewFilter'))->render());
        }

        if ($isAjax) {
            return response()->json(view('partials/_offers-list', compact('offers', 'filter', 'isAjax'))->render());
        }

        return view('partials/_offers-list', compact('offers', 'filter'));
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

    public function deleteUploadedFileAssociatedWithOffer($id) {
        $offer = Offer::find($id);

        if (!preg_match('/generic/', $offer->picture)) {
            Storage::delete('public/images/' . $offer->picture);
        }
    }

    /*
     * Select the offer that matches the 'id' passed as a parameter.
     *
     * @param string $id
     */
    public function single($id) {
        $offer = Offer::find($id);

        return view(('pages/job-description'), compact('offer'));
    }
}
