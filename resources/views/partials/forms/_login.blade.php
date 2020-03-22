@slot('name', 'login')
@slot('bag', 'login')
@slot('title', __('Login'))

@slot('body')
    <form method="POST" action="{{ route('login') }}" class="modal__form">
        @csrf
        <div class="form-group">
            <label for="login-email" class="col-form-label">{{ __('auth.e-mail address') }}</label>
            <input type="text" class="form-control{{ $errors->login->has('email') ? ' is-invalid' : '' }}" id="login-email" name="email" placeholder="{{ __('content.email placeholder') }}" value="{{ old('email') }}" required autofocus>
            @if ($errors->login->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->login->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="login-password" class="col-form-label">{{ __('auth.password') }}</label>
            <input type="password" class="form-control{{ $errors->login->has('password') ? ' is-invalid' : '' }}" id="login-password" name="password" required>
            @if ($errors->login->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->login->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            @component('components.inputs.switch')
                @slot('name', 'remember')
                @slot('label', __('Remember Me'))
            @endcomponent
{{--            <div class="form-check pl-0">--}}
{{--                <label aria-label="remember">{{ __('auth.remember me') }}</label>--}}
{{--                <label class="switch col-form-label" for="remember">--}}
{{--                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                    <i class="checkbox_slider fas checkbox_slider--rounded"></i>--}}
{{--                </label>--}}
{{--            </div>--}}
        </div>
        <div class="form-group">
            @component('components.inputs.shutter-button')
                @slot('variant', 'modal')
                @slot('content', __('auth.login'))
                @slot('type', 'submit')
            @endcomponent
            @component('components.inputs.shutter-button')
                @slot('variant', 'modal')
                @slot('content', __('auth.cancel'))
                @slot('type', 'reset')
            @endcomponent
        </div>
    </form>
@endslot

@slot('footer')
    @if (Route::has('password.request'))
        <a class="modal-link" href="{{ route('password.request') }}">
            {{ __('auth.forgot your password?') }}
        </a>
    @endif
@endslot
