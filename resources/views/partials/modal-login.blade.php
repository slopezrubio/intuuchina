<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLongTitle">Iniciar Sesión</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUsername" class="col-form-label">{{ __('E-Mail Address') }}</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="inputUsername" name="email" placeholder="Nombre de usuario" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">Contraseña</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="inputPassword" name="password" placeholder="Contraseña" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-column">
                    <button type="submit" class="modal-button modal-button_primary">{{ __('Login') }}</button>
                    <button type="button" class="modal-button modal-button_secondary" data-dismiss="modal">Cancelar</button>
                    @if (Route::has('password.request'))
                        <a class="modal-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>