<?php

namespace App\Http\Controllers;

use App\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FeesController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        return view('pages/admin/fee', [
            'fee' => Fee::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $fee = Fee::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'heading' => ['required', 'string', 'max:255'],
            'unit' => [
                Rule::RequiredIf(function() use ($fee) {
                    return $fee->type === 'unit_rate';
                }),
            ],
            'minimum' => [
                Rule::RequiredIf(function() use ($fee) {
                    return $fee->type === 'unit_rate';
                }),
                'numeric', 'nullable',
            ],
            'amount' => ['required', 'numeric'],
            'tax' => 'required'
        ], [
            'unit.required' => __('validation.custom.unit.required'),
            'tax.required' => __('validation.custom.tax.required'),
        ]);

        if ($validator->errors()->any()) {
            $request->flash();

            return Redirect::back()->withErrors($validator->errors()->getMessages());
        }

        $fee->update([
            'name' => $request->get('name'),
            'unit' => $fee->feeType->value === 'unit_rate'
                        ? $request->get('unit') : null,
            'minimum' => $fee->feeType->value === 'unit_rate'
                        ? $request->get('minimum') : null,
            'amount' => $request->get('amount'),
            'jurisdiction' => $request->get('tax'),
        ]);

        return redirect()->route('admin.edit-fee', $fee->id)
            ->with('status', 'completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fee $fee)
    {
        Fee::destroy($fee->id);

        return redirect()->route('admin.fees');
    }
}
