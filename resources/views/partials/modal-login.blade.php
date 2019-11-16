<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('content.login') }}</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('login') }}" class="modal__form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUsername" class="col-form-label">{{ __('auth.e-mail address') }}</label>
                        <input type="text" class="form-control{{ $errors->has('email') && !$errors->has('register.email') ? ' is-invalid' : '' }}" id="inputUsername" name="email" placeholder="{{ __('content.email placeholder') }}" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email') && !$errors->has('register.email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">{{ __('auth.password') }}</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check pl-0">
                            <label aria-label="remember">{{ __('auth.remember me') }}</label>
                            <label class="switch col-form-label" for="remember">
                                <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-column">
                    <button type="submit" class="modal-button modal-button_primary">{{ __('auth.login') }}</button>
                    <button type="button" class="modal-button modal-button_secondary" data-dismiss="modal">{{ __('auth.cancel') }}</button>
                    @if (Route::has('password.request'))
                        <a class="modal-link" href="{{ route('password.request') }}">
                            {{ __('auth.forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>