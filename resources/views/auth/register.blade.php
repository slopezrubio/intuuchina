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
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('content.name') }}</label>

                                    <div class="col-md-8 pl-md-0">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
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
                                        <input id="surnames" type="text" class="form-control{{ $errors->has('surnames') ? ' is-invalid' : '' }}" name="surnames" value="{{ old('surnames') }}" required>

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
                                    <input type="email" class="form-control{{ $errors->has('register.email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('content.email placeholder') }}" required>

                                    @if ($errors->has('register.email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('register.email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-3 col-form-label text-md-left">{{ __('content.phone number') }}</label>
                                <div class="col-3 col-md-3">
                                    <div class="regular-select-wrapper">
                                        <select name="prefix" id="prefix" class="form-control">
                                            @foreach (__('prefixes') as $key => $value)
                                                <option value="{{ $key }}">{{ $value['prefix'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9 col-md-6">
                                    <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                @include('partials._nationality-selector')
                            </div>

                            <div class="form-group row" id="programFieldset">
                                <label for="inputProgram" class="col-md-3 col-form-label text-md-left">{{ __('content.program') }}</label>
                                <div class="col-md-9">
                                    <div class="regular-select-wrapper">
                                        <select class="form-control" id="inputProgram" name="program">
                                            @foreach (__('content.programs') as $key => $program)
{{--                                                @if ($i === 0)--}}
{{--                                                    @if(empty(session('options')))--}}
{{--                                                        <option value="{{ __('content.programs')[$i]['value'] }}" aria-selected="true" selected>{{ __('content.programs')[$i]['text'] }}</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="internship" aria-selected="{{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'true' : 'false' }}" {{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'selected' : '' }}>--}}
{{--                                                            {{ __('content.programs')[$i]['text'] }}--}}
{{--                                                        </option>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
                                                    <option value="{{ $key }}" aria-selected="{{ isset(session('options')['program']) && session('options')['program'] === $key ? 'true' : 'false' }}" {{ isset(session('options')['program']) && session('options')['program'] === $key ? 'selected' : '' }}>{{ $program }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="industryFieldset">
                                <label for="inputIndustry" class="col-md-3 col-form-label text-md-left">{{ __('content.industry') }}</label>
                                <div class="col-md-9">
                                @foreach (__('content.industries') as $key => $industry)
                                    <div class="sw_input">
                                        <label aria-label="{{ $key }}">{{ $industry }}</label>
                                        <label for="{{ $key }}" class="switch">
                                            @if(isset(session('options')['internship']) && session('options')['internship'] === $key)
                                                <input id="{{ $industry }}" type="checkbox" value="{{ $key }}" name="industry[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="industry[]">
                                            @endif
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="form-group row" id="studyFieldset">
                                <label for="inputStudy" class="col-md-3 col-form-label text-md-left">{{ __('content.study chinese via') }}</label>
                                <div class="col-md-9">

                                    @foreach(__('content.studies') as $key => $study)
                                        <div class="sw_input">
                                            <label aria-label="{{ $key }}">{{ $study }}</label>
                                            <label for="{{ $key }}" class="switch">
                                                @if(isset(session('options')['study']) && session('options')['study'] === $key)
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

                            <div class="form-group row" id="universityFieldset">
                                <label for="inputUniversity" class="col-md-3 col-form-label text-md-left">{{ __('content.programs.university') }}</label>
                                <div class="col-md-9">

                                @foreach(__('content.universities') as $key => $degree)
                                    <div class="sw_input">
                                        <label aria-label="{{ $key }}">{{ $degree }}</label>
                                        <label for="{{ $key }}" class="switch">
                                            <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="university[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endforeach

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-left">{{ __('Password') }}</label>
                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
