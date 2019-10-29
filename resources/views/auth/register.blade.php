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
        @include('partials._header.')
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="card extended-form">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('content.name') }}</label>

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
                                    <label for="surnames" class="offset-md-1 col-md-5 col-form-label text-md-left">{{ __('content.surnames') }}</label>
                                    <div class="col-md-6">
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
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('content.email placeholder') }}" required>

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
                                <label for="inputProgram" class="col-md-3 col-form-label text-md-left">{{ __('content.program') }}</label>
                                <div class="col-md-9">
                                    <div class="regular-select-wrapper">
                                        <select class="form-control" id="inputProgram" name="program">
                                            @for ($i = 0; $i < count(__('content.programs')); $i++)
{{--                                                @if ($i === 0)--}}
{{--                                                    @if(empty(session('options')))--}}
{{--                                                        <option value="{{ __('content.programs')[$i]['value'] }}" aria-selected="true" selected>{{ __('content.programs')[$i]['text'] }}</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="internship" aria-selected="{{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'true' : 'false' }}" {{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'selected' : '' }}>--}}
{{--                                                            {{ __('content.programs')[$i]['text'] }}--}}
{{--                                                        </option>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
                                                    <option value="{{ __('content.programs')[$i]['value'] }}" aria-selected="{{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'true' : 'false' }}" {{ isset(session('options')['program']) && session('options')['program'] === __('content.programs')[$i]['value'] ? 'selected' : '' }}>{{ __('content.programs')[$i]['text'] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="industryFieldset">
                                <label for="inputIndustry" class="col-md-3 col-form-label text-md-left">{{ __('content.industry') }}</label>
                                <div class="col-md-9">
                                @for($i = 0;$i <  count(__('content.offers filter options')); $i++)
                                    <div class="sw_input">
                                        <label aria-label="{{ __('content.offers filter options')[$i]['value'] }}">{{ __('content.offers filter options')[$i]['text'] }}</label>
                                        <label for="{{ __('content.offers filter options')[$i]['value'] }}" class="switch">
                                            @if(isset(session('options')['internship']) && session('options')['internship'] === __('content.offers filter options')[$i]['value'])
                                                <input id="{{ __('content.offers filter options')[$i]['value'] }}" type="checkbox" value="{{ __('content.offers filter options')[$i]['value'] }}" name="industry[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="{{ __('content.offers filter options')[$i]['value'] }}" type="checkbox" value="{{ __('content.offers filter options')[$i]['value'] }}" name="industry[]">
                                            @endif
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endfor
                                </div>
                            </div>

                            <div class="form-group row" id="studyFieldset">
                                <label for="inputStudy" class="col-md-3 col-form-label text-md-left">{{ __('content.study chinese') }}</label>
                                <div class="col-md-9">
                                    <div class="sw_input">
                                        <label aria-label="online">{{ __('content.online') }}</label>
                                        <label for="online" class="switch">
                                            @if(isset(session('options')['study']) && session('options')['study'] === 'online')
                                                <input id="online" type="checkbox" value="online" name="study[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="online" type="checkbox" value="online" name="study[]">
                                            @endif
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                    <div class="sw_input">
                                        <label aria-label="presencial">{{ __('content.in-person') }}</label>
                                        <label for="presencial" class="switch">

                                            @if(isset(session('options')['study']) && session('options')['study'] === 'presencial')
                                                <input id="presencial" type="checkbox" value="presencial" name="study[]" aria-checked="true" checked="true">
                                            @else
                                                <input id="presencial" type="checkbox" value="presencial" name="study[]">
                                            @endif

                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="universityFieldset">
                                <label for="inputUniversity" class="col-md-3 col-form-label text-md-left">{{ __('content.university') }}</label>
                                <div class="col-md-9">

                                @for($i = 0;$i <  count(__('content.university checkbox')); $i++)
                                    <div class="sw_input">
                                        <label aria-label="{{ __('content.university checkbox')[$i]['value'] }}">{{ __('content.university checkbox')[$i]['text'] }}</label>
                                        <label for="{{ __('content.university checkbox')[$i]['value'] }}" class="switch">
                                            <input id="{{ __('content.university checkbox')[$i]['value'] }}" type="checkbox" value="{{ __('content.university checkbox')[$i]['value'] }}" name="university[]">
                                            <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                                        </label>
                                    </div>
                                @endfor

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
