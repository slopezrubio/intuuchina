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
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="inputUsername" name="email" placeholder="{{ __('content.email placeholder') }}" required autofocus>
                        @if ($errors->has('email'))
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('auth.remember me') }}
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