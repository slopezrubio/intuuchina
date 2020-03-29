@slot('name', 'login')
@slot('bag', 'login')
@slot('title', __('Login'))

@slot('body')
    <form method="POST" action="{{ route('login') }}" class="modal__form" id="login">
        @csrf
        <div class="form-group">
            @component('components.inputs.label')
                @slot('bag', 'login')
                @slot('name', 'email')
                {{ __('auth.e-mail address') }}
            @endcomponent
            @component('components.inputs.text')
                @slot('bag', 'login')
                @slot('name', 'email')
                @slot('placeholder', __('placeholder.email.default'))
                @slot('autofocus', true)
                @slot('required', true)
            @endcomponent
        </div>
        <div class="form-group">
            @component('components.inputs.label')
                @slot('bag', 'login')
                @slot('name', 'password')
                {{ __('auth.password') }}
            @endcomponent
            @component('components.inputs.text')
                @slot('bag', 'login')
                @slot('name', 'password')
                @slot('type', 'password')
            @endcomponent
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
