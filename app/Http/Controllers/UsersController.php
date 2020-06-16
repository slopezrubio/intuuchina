<?php

namespace App\Http\Controllers;

use App\Program;
use App\Rules\CurriculumVitae;
use App\Status;
use App\User;
use App\State;
use DBlackborough\Quill\Render as QuillRender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
                Rule::requiredIf(function() use ($request, $user) {
                    if ($request->get('program') !== 'study') {
                        return $user->cv === null || !Storage::exists($user->cv);
                    }

                    return false;
                }),
                'file', 'max:2000', 'mimes:pdf,doc,docx,odt,zip'
            ],
        ], [
            'cv.required' => Auth::user()->type !== 'admin'
                                ? __('validation.custom.required', ['attribute' => __('CV')])
                                : __('validation.custom.admin.required', ['attribute' => __('CV')])
        ]);

        if ($validator->errors()->any()) {
            $request->flash();

            if (auth()->user()->type === 'user') {
                return Redirect::route('user.profile')->withErrors($validator->errors()->getMessages(), 'profile');
            }

            return Redirect::back()->withErrors($validator->errors()->getMessages(), 'profile');
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
                                : $user->status_id,
        ]);

        if (Auth::user()->type === 'admin') {
            return redirect()->route('admin')
                            ->with('status', trans('validation.custom.completed' , ['item' => 'profile']));
        }

        return redirect()->route('user.profile')
                            ->with('status', trans('validation.custom.completed' , ['item' => 'profile']));
    }

    public function edit($id) {
        return view('pages/admin/user', [
            'user' => User::find($id)
        ]);
    }

    public function showChangePasswordForm($token) {
        return view('auth.passwords.change');
    }

    public function upgrade(Request $request, $id) {
        if ($request->isMethod('post')) {

            $quill = new QuillRender($request->get('message'));
            $message = $quill->render();

            $validator = Validator::make($request->all(), [
                'attachments' => ['file', 'max:2000', 'mimes:pdf,doc,docx,odt,zip']
            ]);

            if ($validator->errors()->any()) {
                $request->flash();

                return Redirect::back()->withErrors($validator->errors()->getMessages());
            }

            $user = User::find($id);

            $user->sendUserUpgradeNotification($message, $request->file('attachments'));

            $user->update([
                'status_id' => Status::getByValue($request->get('status')) !== null
                    ? Status::getByValue($request->get('status'))->id
                    : null,
            ]);
        }

        return view('pages/admin/upgrade', [
            'user' => User::find($id)
        ]);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(),[
            'current_password' => [
                function($attribute, $value, $fail) use ($request) {
                    $credentials = [
                        'email' => Auth::user()->email,
                        'password' => $request->get('current_password'),
                    ];

                    if (!Auth::attempt($credentials)) {
                        return $fail(__('validation.custom.password.not current'));
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors()->getMessages());
        }

        $request->user()->fill([
            'password' => Hash::make($request->get('password')),
        ])->save();

        if (Auth::user()->type === 'admin') {
            return Redirect::route('admin')
                ->with('status', trans('validation.custom.completed', ['item' => 'password']));
        }

        return Redirect::route('home')
                ->with('status', trans('validation.custom.completed', ['item' => 'password']));
    }

    public function destroy($id) {
        $user = User::find($id);

        $user->destroyAssociatedFiles();

        User::destroy($user->id);

        return redirect()->route('admin.users');
    }
}
