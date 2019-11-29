<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator as v;

class ValidationsController extends Controller
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
     * Validates the given field with its own validators.
     *
     * @param Request $field
     * @return string
     */
    public function validateField(Request $field) {
        $validators = $field->get('validators');

        if (is_string($validators)) {

            $errors = $field->validate([
                'value' => $field->get('validators')
            ]);

        } else if (is_array($validators)) {
            for ($i = 0; $i < count($validators); $i++) {
                if (class_exists('\\App\\Rules\\' . $validators[$i])) {
                    $validatorClass = '\\App\\Rules\\' . $validators[$i];
                    $errors = $field->validate([
                        'value' => new $validatorClass()
                    ]);

                } else {

                    $errors = $field->validate([
                        'value' => $validators[$i]
                    ]);

                }
            }

        }

        if (empty($errors)) {
            return "success";
        }

        return $errors;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
