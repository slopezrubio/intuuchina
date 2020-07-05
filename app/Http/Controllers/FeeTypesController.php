<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeType;
use App\Program;

class FeeTypesController extends Controller
{
    public function getPrograms(Request $request) {
        $feeType = FeeType::where('value', $request->get('fee_type'))->first();

        return response()->json($feeType->programs);
    }
}
