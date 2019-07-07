<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
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
        $offers = $this->all();

        /* Datos adicionales que se van a entregar a la vista */
        $params = (object) array(
            'title' => 'Prácticas'
        );

        return view('pages/offers', compact('offers', 'params'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $offers = $this->all();

        /* Datos adicionales que se van a entregar a la vista */
        $params = (object) array(
            'title' => 'Prácticas'
        );

        return view('pages/admin/offers', compact('offers', 'params'));
    }

    public function all() {
        /*
         * Realiza la consulta a la base de datos para seleccionar todos los datos ordenados
         * por la fecha de creación.
         */
        $offers = Offer::orderBy('created_at','DESC')->get();
        $offer = new Offer();
        $offers = $offer->setDaysRenewed($offers);

        return $offers;
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
            'description' => 'max:1000',
            'preferred-skills' => 'max:500',
        ]);


        Offer::create([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'industry' => $request->get('industry'),
            'duration' => $request->get('duration'),
            'description' => $request->get('description'),
            'preferred_skills' => $request->get('preferred-skills'),
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
     * Select all the offers that matches with the name of the industry passed as an argument
     * and send the partial view that comprises just the list of offers.
     */
    public function filterBy($filter) {
        if ($filter !== 'all') {
            $offers = Offer::where('industry', $filter)->orderBy('created_at', 'DESC')->get();
            $offer = new Offer();
            $offers = $offer->setDaysRenewed($offers);
            return view('partials/_offers-list', compact('offers', 'params'));
        }

        $offers = $this->all();
        return view('partials/_offers-list', compact('offers', 'params'));
    }

    /*
     * Select the offer that matches the 'id' passed as a parameter.
     *
     * @param string $id
     */
    public function single($id) {
        $offer = Offer::find($id);

        /* Datos adicionales que se van a entregar a la vista */
        $params = (object) array(
            'title' => strtoupper($offer->industry),
            'subtitle' => $offer->title
        );

        return view(('pages/job-description'), compact('offer', 'params'));
    }
}
