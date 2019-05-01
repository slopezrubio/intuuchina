<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'job-type' => 'required|string',
            'education' => 'required|string',
            'duration' => 'required|string',
            'description' => 'max:1000',
            'preferred-skills' => 'max:500',
            'non-technical-skills' => 'max:500',
        ]);


        Offer::create([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'job_type' => $request->get('job-type'),
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
}
