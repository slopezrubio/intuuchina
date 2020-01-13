@extends('layouts.master')

@section('content')
    <style>
    .hidden {
        display: none !important;
      }
    </style>
    <header class="header header--no-background-image" id="register">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11 col-lg-8 col-xl-8">
                <div class="card extended-form">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('content.name') }}</label>

                                    <div class="col-md-8 pl-md-0">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ml-md-auto">
                                    <label for="surnames" class="col-md-4 col-xl-4 col-form-label text-md-left">{{ __('content.surnames') }}</label>
                                    <div class="col-md-8 pl-md-0 col-xl-8">
                                        <input id="surnames" type="text" class="form-control{{ $errors->has('surnames') ? ' is-invalid' : '' }}" name="surnames" value="{{ old('surnames') }}">

                                    @if ($errors->has('surnames'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surnames') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-left">{{ __('content.e-mail address') }}</label>

                                <div class="col-md-9">
                                    <input type="email" class="form-control{{ $errors->has('register.email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('content.email placeholder') }}">

                                    @if ($errors->has('register.email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $errors->first('register.email') !!}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-3 col-form-label text-md-left">{{ __('content.phone number') }}</label>
                                <div class="col-4 col-md-2">
                                    <div class="regular-select-wrapper">
                                        <select name="prefix" id="prefix" class="form-control">
                                            @foreach (__('prefixes') as $key => $value)
                                                <option value="{{ $key }}">{{ $value['prefix'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8 col-md-7">
                                    <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputNationality" class="col-md-3 col-form-label text-md-left">{{ __('Nationality') }}</label>
                                <div class="col-md-9">
                                    <div class="regular-select-wrapper">
                                        <select id="nationality" type="text" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" value="{{ old('nationality') }}" required>
                                            @foreach (__('countries.nationalities') as $key => $nationality))
                                            <option value="{{ $key }}">{{ $nationality }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('nationality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" id="programFieldset">
                                <label for="inputProgram" class="col-md-3 col-form-label text-md-left">{{ __('content.program') }}</label>
                                <div class="col-md-9">
                                    <div class="regular-select-wrapper">
                                        <select class="form-control" id="inputProgram" name="program">
                                            @foreach (__('content.programs') as $key => $program)
                                                @if (session()->has('preferences.program'))
                                                    @if (session('preferences.program') === $key)
                                                        <option value="{{ $key }}" aria-selected="true" selected>{{ __('content.programs')[$key]}}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ __('content.programs')[$key]}}</option>
                                                    @endif
                                                @else
                                                    @if ($loop->first)
                                                        <option value="{{ $key }}" aria-selected="true" selected>{{ __('content.programs')[$key]}}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ __('content.programs')[$key]}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row {{ session()->has('preferences') && !session()->has('preferences.university') ? 'hidden' : ''}}" id="industryFieldset" style="{{ session()->has('preferences.industry') ? 'display: block' : '' }}">
                                <label for="inputIndustry" class="col-md-3 col-form-label text-md-left">{{ __('content.industry') }}</label>
                                <div class="col-md-9">
                                @foreach (__('content.industries') as $key => $industry)
                                    <div class="sw_input">
                                        <label aria-label="{{ $key }}">{{ $industry }}</label>
                                        <label for="{{ $key }}" class="switch">
                                            @if(session()->has('preferences.industry') && session('preferences.industry') === $key)
                                                <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="industry[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="industry[]">
                                            @endif
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="form-group row {{ !session()->has('preferences.study') ? 'hidden' : ''}}" id="studyFieldset" style="{{ session()->has('preferences.study') ? 'display: block' : '' }}">
                                <label for="inputStudy" class="col-md-3 col-form-label text-md-left">{{ __('content.study chinese via') }}</label>
                                <div class="col-md-9">

                                    @foreach(__('content.courses') as $key => $course)
                                        <div class="sw_input">
                                            <label aria-label="{{ $key }}">{{ $course['text'] }}</label>
                                            <label for="{{ $key }}" class="switch">
                                                @if(session()->has('preferences.study') && session('preferences.study') === $key)
                                                    <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="study[]" aria-checked="true" checked="true">
                                                @else
                                                    <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="study[]">
                                                @endif
                                                <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row {{ !session()->has('preferences.university') ? 'hidden' : ''}}" id="universityFieldset" style="{{ session()->has('preferences.university') ? 'display: block' : '' }}">
                                <label for="inputUniversity" class="col-md-3 col-form-label text-md-left">{{ __('content.programs.university') }}</label>
                                <div class="col-md-9">

                                @foreach(__('content.universities') as $key => $degree)
                                    <div class="sw_input">
                                        <label aria-label="{{ $key }}">{{ $degree['heading'] }}</label>
                                        <label for="{{ $key }}" class="switch">
                                            @if(session()->has('preferences.university') && session('preferences.university') === $key)
                                                <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="university[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="study[]">
                                            @endif
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cv" class="col-md-3 col-form-label text-md-left">{{ __('content.cv') }}</label>

                                <div class="col-md-9">
                                    <input type="file" name="cv" class="form-control{{ $errors->has('cv') || $errors->has('PostTooLargeException') ? ' is-invalid' : '' }}" id="cv">
                                    @if ($errors->has('cv'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cv') }}</strong>
                                        </span>
                                    @elseif($errors->has('PostTooLargeException'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('PostTooLargeException') }}</strong>
                                        </span>
                                    @else
                                        <small class="text-muted" role="alert">
                                            <strong>{{ __('auth.allowed cv document formats') }}</strong>
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-left">{{ __('Password') }}</label>
                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                <div class="col-md-9">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-10" aria-label="terms">{!! trans('content.i accept the') !!}</label>

                                <div class="col-md-2">
                                    <label for="terms-register" class="switch ml-md-auto mt-0 form-control{{ $errors->has('terms-register') ? ' is-invalid' : '' }}">
                                        <input id="terms-register" class="form-control" name="terms-register" type="checkbox">
                                        <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                    </label>
                                    @if ($errors->has('terms-register'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('terms-register') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-6 col-md-4">
                                    <button type="submit" class="shutter-button">
                                        {{ __('auth.register') }}
                                    </button>
                                </div>
                                <div class="col-6 col-md-4">
                                    <button type="reset" class="shutter-button">
                                        {{ __('auth.cancel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection
