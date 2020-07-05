<?php

namespace App\Http\Controllers;

use App\Fee;
use App\FeeType;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.new-fee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        $validator->validate();

        $fee = Fee::create([
            'name' => $request->name,
            'type' => FeeType::where('value', $request->fee_type)->first()->id,
            'heading' => $request->heading,
            'value' => Str::snake(strtolower($request->name)),
            'unit' => $request->fee_type === 'unit_rate' ? $request->unit : null,
            'amount' => $request->amount,
            'jurisdiction' => $request->tax,
            'minimum' => $request->fee_type === 'unit_rate' ? $request->minimum : null,
        ]);

        $program = Program::where('value', $request->program)->first();

        $fee->syncCategories($request->categories);

        return redirect()->route('admin.fees')
            ->with('status', trans('validation.custom.created', ['item' => 'fee']));

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


    private function validator(Request $request) {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'heading' => ['required', 'string', 'max:255'],
            'unit' =>  [
                Rule::requiredIf(function() use ($request) {
                    return $request->get('fee_type') === 'unit_rate';
                }),
                'nullable',
                'alpha',
                'max:255'
            ],
            'minimum' => [
                Rule::requiredIf(function() use ($request) {
                    return $request->get('fee_type') === 'unit_rate';
                }),
                'nullable',
                'integer'
            ],
            'amount' => ['required', 'numeric'],
        ], [
            'unit.required' => __('validation.custom.unit.required'),
            'minimum.required' => __('validation.custom.admin.minimum.required')
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

        $validator = $this->validator($request);

        $validator->validate();

        $fee->update([
            'name' => $request->get('name'),
            'unit' => $fee->feeType->value === 'unit_rate' ? $request->get('unit') : null,
            'minimum' => $fee->feeType->value === 'unit_rate' ? $request->get('minimum') : null,
            'amount' => $request->get('amount'),
            'jurisdiction' => $request->get('tax'),
        ]);

        $fee->syncCategories($request->categories);

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
        $fee->syncCategories();

        Fee::destroy($fee->id);

        return redirect()->route('admin.fees');
    }
}
