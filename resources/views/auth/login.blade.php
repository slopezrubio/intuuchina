@extends('layouts.master')

@section('title')
    {{ __('meta.title.' . $view_name) }}
@endsection

@section('content')
    <main class="full-viewport" id="login">
        <div class="container">
            <div class="col-md-9 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('auth.login') }}</span>
                        <span><a href="{{ url('/') }}">{{ __('auth.back to home') }}</a> | <a href="{{ route('register') }}">{{ __('auth.register') }}</a></span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-4">
                                    @component('components.inputs.label')
                                        @slot('name', 'email')

                                        {{ __('E-Mail Address') }}
                                    @endcomponent
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    @component('components.inputs.text')
                                        @slot('name', 'email')
                                        @slot('type', 'email')
                                        @slot('bag', 'login')
                                        @slot('id', 'email')
                                    @endcomponent
                                </div>
{{--                                    <label for="email" class="col-12 col-sm-12 col-md-4 col-form-label text-left">{{ __('auth.e-mail address') }}</label>--}}
{{--                                    <div class="col-12 col-sm-12 col-md-8">--}}
{{--                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">--}}
{{--                                        @if ($errors->has('email'))--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-4">
                                    @component('components.inputs.label')
                                        @slot('name', 'password')

                                        {{ __('Password') }}
                                    @endcomponent
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    @component('components.inputs.text')
                                        @slot('name', 'password')
                                        @slot('type', 'password')
                                        @slot('bag', 'login')
                                        @slot('id', 'password')
                                    @endcomponent
                                </div>
{{--                                    <label for="password" class="col-12 col-sm-12 col-md-4 col-form-label text-left">{{ __('auth.password') }}</label>--}}
{{--                                    <div class="col-12 col-sm-12 col-md-8">--}}
{{--                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">--}}
{{--                                    </div>--}}
{{--                                    @if ($errors->has('password'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                </span>--}}
{{--                                    @endif--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-8 offset-md-4">
                                    @component('components.inputs.switch')
                                        @slot('name', 'remember')
                                        @slot('label', __('Remember Me'))
                                    @endcomponent
                                </div>
{{--                                    <div class="col-md-8 offset-md-4">--}}
{{--                                        <div class="row col-12 align-items-center">--}}
{{--                                            <label class="switch" for="remember">--}}
{{--                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                                <i class="checkbox_slider fas checkbox_slider--rounded"></i>--}}
{{--                                            </label>--}}
{{--                                            <label class="col-8" aria-label="remember">{{ __('auth.remember me') }}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-1 col-sm-10">
                                    @component('components.inputs.cta-button')
                                        @slot('variant', 'primary')
                                        @slot('content', __('auth.login'))
                                    @endcomponent
                                </div>
{{--                                    <div class="offset-sm-1 col-sm-10 offset-sm-1 offset-md-2 col-md-8 offset-md-2 offset-lg-3 col-lg-6 offset-lg-3">--}}
{{--                                        <button type="submit" class="cta">{{ __('auth.login') }}</button>--}}
{{--                                    </div>--}}
                            </div>
                            <div class="form-group row justify-content-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('auth.forgot your password?') }}</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 attribution-text">
                Photo by <a href="https://unsplash.com/@ly0ns?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Li Yang">Li Yang</a>
            </div>
        </div>
    </main>
@endsection
