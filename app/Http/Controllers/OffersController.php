<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Offer;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offers = Offer::orderBy('created_at','DESC')->get();

        foreach ($offers as $offer) {
            $this->renew($offer->id, $offer->created_at);
            $offer->gone_by = $this->getDiffForHumans($offer->created_at);
        }

        return view('pages/admin/offers', compact('offers'));
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
            'education' => 'required|string',
            'duration' => 'required|string',
            'description' => 'max:1000',
            'preferred-skills' => 'max:500',
            'non-technical-skills' => 'max:500',
        ]);


        Offer::create([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'industry' => $request->get('industry'),
            'education' => $request->get('education'),
            'duration' => $request->get('duration'),
            'description' => $request->get('description'),
            'preferred_skills' => $request->get('preferred-skills'),
            'non_technical_skills' => $request->get('non-technical-skills'),
        ]);

        return redirect()->route('offers');
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Get the difference between the creation Date of an offer and the current time
     *
     * @param string $date
     * @return string
     */
    public function getDiffForHumans($date) {
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }

    /*
     * Updates the date of creation of all the offers which were created two months ago to make
     * them firstly visible again when they are listed.
     *
     * @param string $date
     */
    public function renew($offer, $date) {
        $differenceFromNow = Carbon::parse($date)->floatDiffInMonths(Carbon::now());
        $dateLimitWithoutRenewing = 2;
        if ($dateLimitWithoutRenewing <= $differenceFromNow) {
            Offer::where('id', $offer)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }
}
