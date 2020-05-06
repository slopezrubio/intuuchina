<?php

namespace App\Http\Controllers;

use App\Program;
use App\Rules\CurriculumVitae;
use App\Status;
use App\User;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function confirm(Request $request) {

        // Gets the authenticated user and updates his status.
        $user = User::find(Auth::id());
        $user = $user->updateStatus('verified');

        $currentStatus = State::find($user->status_id)->name;

        return view('partials/forms/dialog-box-' . $currentStatus);
    }

    public function single($id) {

    }

    public function update($id, Request $request) {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'surnames' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'max:255'],
            'cv' => [
                Rule::requiredIf(function() use ($request) {
                    if (request()->get('program') !== 'study') {
                        return $request->user()->cv === null || !Storage::exists($request->user()->cv);
                    }

                    return false;
                }),
                'file', 'max:2000', 'mimes:pdf,doc,docx,odt,zip'
            ],
        ], [
            'cv.required' => __('validation.custom.required', ['attribute' => __('CV')])
        ]);

        if ($validator->errors()->any()) {
            $request->flash();

            if (auth()->user()->type === 'user') {
                return Redirect::route('user.profile')->withErrors($validator->errors()->getMessages());
            }

            return Redirect::back()->withErrors($validator->errors()->getMessages());
        }

        $user->update([
            'name' => $request->get('name'),
            'surnames' => $request->get('surnames'),
            'nationality' => $request->get('nationality'),
            'program_id' => Program::getByValue($request->get('program')) !== null
                                ? Program::getByValue($request->get('program'))->id
                                : null,
            'categories' => $request->get('categories'),
            'status_id' => Status::getByValue($request->get('status')) !== null
                                ? Status::getByValue($request->get('status'))->id
                                : null,
        ]);

        if (Auth::user()->type === 'admin') {
            return redirect()->route('admin.users');
        }

        return redirect()->route('user.profile');
    }

    public function edit($id) {
        return view('pages/admin/user', [
            'user' => User::find($id)
        ]);
    }

    public function destroy($id) {
        $user = User::find($id);

        $user->destroyAssociatedFiles();

        User::destroy($user->id);

        return redirect()->route('admin.users');
    }
}
