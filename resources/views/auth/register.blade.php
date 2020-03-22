@extends('layouts.master')

@section('content')
    <style>
    .hidden {
        display: none !important;
    }
    </style>
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('title', __('component.header.register.title'))
    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8 col-xl-8">
                <form id="signup-form" class="extended-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="p-0 col-12 col-md-6 form-group d-flex flex-wrap flex-md-row">
                            <div class="col-12 col-md-4">
                                @component('components.inputs.label', ['name' => 'name', 'bag' => 'register'])
                                    {{ __('Name') }}
                                @endcomponent
                            </div>
                            <div class="col-12 col-md-8">
                                @component('components.inputs.text')
                                    @slot('bag', 'register')
                                    @slot('name', 'name')
                                    @slot('value', old('name'))
                                @endcomponent
{{--                                <input id="name" type="text" class="c-text-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>--}}
{{--                                @if ($errors->has('name'))--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('name') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                        <div class="p-0 col-12 col-md-6 form-group d-flex flex-wrap flex-md-row">
                            <div class="col-12 col-md-4">
                                @component('components.inputs.label', ['name' => 'surnames', 'bag' => 'register'])
                                    {{ __('Surnames') }}
                                @endcomponent
                            </div>
                            <div class="col-12 col-md-8">
                                @component('components.inputs.text')
                                    @slot('bag', 'register')
                                    @slot('name', 'surnames')
                                    @slot('value', old('surnames'))
                                @endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'email', 'bag' => 'register'])
                                {{ __('E-Mail Address') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9">
                            @component('components.inputs.text')
                                @slot('name', 'email')
                                @slot('bag', 'register')
                                @slot('value', old('email'))
                                @slot('placeholder', __('placeholder.email.default'))
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'phone-number'])
                                {{ __('Phone Number') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9 d-flex p-0">
                            @component('components.inputs.phone')
                                @slot('name', 'phone_number')
                                @slot('value', old('phone_number'))
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'nationality'])
                                {{ __('Nationality') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9">
                            @component('components.inputs.select', ['options' =>  __('countries.nationalities')])
                                @slot('name', 'nationality')
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row" id="programFieldset">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'program'])
                                {{ __('Program') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9">
                            @component('components.inputs.select', ['options' => __('content.programs')])
                                @slot('name', 'program')
                                @slot('value', session()->has('preferences.program') ? session('preferences.program') : array_key_first(__('content.programs')))
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row" id="industryFieldset" style="{{ !session()->has('preferences') || session()->has('preferences.industry') ? '' : 'display:none' }}">
                        @component('components.inputs.checkbox-group', ['inputs' => __('content.industries')])
                            @slot('name', 'inter_relocat')
                            @slot('label', __('Industry'))
                        @endcomponent
                    </div>

                    <div class="form-group row" id="studyFieldset" style="{{ session()->has('preferences') && session()->has('preferences.study') ? '' : 'display:none'}}">
                        @component('components.inputs.checkbox-group', ['inputs' => __('content.courses')])
                            @slot('name', 'study')
                            @slot('label', __('Study Chinese Via'))
                        @endcomponent
                    </div>

                    <div class="form-group row" id="universityFieldset" style="{{ session()->has('preferences') && session()->has('preferences.university') ? '' : 'display:none'}}">
                        @component('components.inputs.checkbox-group', ['inputs' => __('content.universities')])
                            @slot('name', 'university')
                            @slot('label',  __('University'))
                        @endcomponent
                    </div>

                    <div class="form-group row">
                        @component('components.inputs.file')
                            @slot('name', 'cv')
                            @slot('label', __('CV'))
                            @slot('muted',  __('auth.allowed cv document formats'))
                        @endcomponent
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'password'])
                                {{ __('Password') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9">
                            @component('components.inputs.text')
                                @slot('name', 'password')
                                @slot('type', 'password')
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            @component('components.inputs.label', ['name' => 'password'])
                                {{ __('Confirm Password') }}
                            @endcomponent
                        </div>
                        <div class="col-md-9">
                            @component('components.inputs.text')
                                @slot('name', 'password_confirmation')
                                @slot('type', 'password')
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            @component('components.inputs.switch')
                                @slot('name', 'terms')
                                @slot('label')
                                    {!! __('content.i accept the') !!}
                                @endslot
                                @slot('bag', 'register')
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-6 col-md-4">
                            @component('components.inputs.shutter-button')
                                @slot('type', 'submit')
                                @slot('content', __('auth.register') )
                            @endcomponent
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            @component('components.inputs.shutter-button')
                                @slot('type', 'reset')
                                @slot('content', __('auth.cancel') )
                            @endcomponent
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection
