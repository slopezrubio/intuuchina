@extends('layouts.master')

@section('content')
    <style>
    .hidden {
        display: none !important;
      }
    </style>
    <header id="register">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card extended-form">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surnames" class="col-md-4 col-form-label text-md-right">{{ __('Surnames') }}</label>
                                <div class="col-md-6">
                                    <input id="surnames" type="text" class="form-control{{ $errors->has('surnames') ? ' is-invalid' : '' }}" name="surnames" value="{{ old('surnames') }}" required>

                                    @if ($errors->has('surnames'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surnames') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                @include('partials._nationality-selector')
                            </div>

                            <div class="form-group row" id="programFieldset">
                                <label for="inputProgram" class="col-md-4 col-form-label text-md-right">Program</label>
                                <div class="col-md-6">
                                    <div class="regular-select-wrapper">
                                        <select class="form-control" id="inputProgram" name="program">
                                            <option value="internship" aria-selected="true" selected>Internship program</option>
                                            <option value="inter_relocat">Internship + Relocation Program</option>
                                            <option value="inter_housing">Internship Including Housing</option>
                                            <option value="study">Study Chinese</option>
                                            <option value="universty">University</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="industryFieldset">
                                <label for="inputIndustry" class="col-md-4 col-form-label text-md-right">Industry</label>
                                <div class="col-md-6">
                                    <div class="sw_input">
                                        <label aria-label="finance">Finance</label>
                                        <label for="finance" class="switch">
                                            <input id="finance" type="checkbox" value="finance" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="design">Design</label>
                                        <label for="design" class="switch">
                                            <input id="design" type="checkbox" value="design" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="engineering">Engineering</label>
                                        <label for="engineering" class="switch">
                                            <input id="engineering" type="checkbox" value="engineering" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="consultant">Consultant</label>
                                        <label for="consultant" class="switch">
                                            <input id="consultant" type="checkbox" value="consultant" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="education">Education</label>
                                        <label for="education" class="switch">
                                            <input id="education" type="checkbox" value="education" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="hospitality">Hospitality</label>
                                        <label for="hospitality" class="switch">
                                            <input id="hospitality" type="checkbox" value="hospitality" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="it">IT</label>
                                        <label for="it" class="switch">
                                            <input id="it" type="checkbox" value="it" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="legal">Legal</label>
                                        <label for="legal" class="switch">
                                            <input id="legal" type="checkbox" value="legal" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="logistic">Logistic</label>
                                        <label for="logistic" class="switch">
                                            <input id="logistic" type="checkbox" value="logistic" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="marketing_business">Marketing & Business Development</label>
                                        <label for="marketing_business" class="switch">
                                            <input id="marketing_business" type="checkbox" value="marketing_business" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="hr">Human Resources</label>
                                        <label for="hr" class="switch">
                                            <input id="hr" type="checkbox" value="hr" name="industry[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="studyFieldset">
                                <label for="inputStudy" class="col-md-4 col-form-label text-md-right">Study Chinese</label>
                                <div class="col-md-6">
                                    <div class="sw_input">
                                        <label aria-label="online">Online</label>
                                        <label for="online" class="switch">
                                            <input id="online" type="checkbox" value="online" name="study[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="presencial">Presencial</label>
                                        <label for="presencial" class="switch">
                                            <input id="presencial" type="checkbox" value="presencial" name="study[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="universityFieldset">
                                <label for="inputUniversity" class="col-md-4 col-form-label text-md-right">University</label>
                                <div class="col-md-6">
                                    <div class="sw_input">
                                        <label aria-label="mba">MBA (Master of Business Administration)</label>
                                        <label for="mba" class="switch">
                                            <input id="mba" type="checkbox" value="mba" name="university[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="mib">M. Intl. Bsns.</label>
                                        <label for="mib" class="switch">
                                            <input id="mib" type="checkbox" value="mib" name="university[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="other">Other</label>
                                        <label for="other" class="switch">
                                            <input id="other" type="checkbox" value="other" name="university[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
