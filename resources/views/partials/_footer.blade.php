<footer>

    <div class="container-fluid footer">
        <div class="footer_header">
            {{--Web Map--}}
            <div class="footer_web-map col-sm-12">
                <div class="footer_title">
                    <h3>Mapa Web</h3>
                </div>
                <div class="footer_web-map_items">
                    <div>
                        <h4 class="footer_subtitle">Prácticas</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="{{ route('offers') }}">Ofertas</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">Aprende Chino</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="{{ url('/learn/1') }}">Presencial</a></li>
                            <li class="web-map_item"><a href="{{ url('/learn/2') }}">Online</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">Universidad</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="#">Master of Business Administration</a></li>
                            <li class="web-map_item"><a href="#">Master of International Business</a></li>
                            <li class="web-map_item"><a href="#">Other</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">Why Intuuchina</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="#">Sobre Nosotros</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{--Contact form--}}
            <form action="{{ route('mail') }}" method="post" class="footer_contact_form col-sm-12">
                @csrf
                <div class="footer_title">
                    <h3>Contact us!</h3>
                </div>
                <div class="col-xs-10 text_input">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="{{ $errors->has('name') ? $errors->first('name') : 'No valen números: e.j. Marta99, Tiana23...' }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                </div>
                <div class="col-xs-10 text_input">
                    <label for="email">Correo</label>
                    <input type="text" name="email" id="email" placeholder="{{ $errors->has('email') ? $errors->first('email') : 'e.j. confucio@confucio.es' }}" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                </div>
                <div class="col-xs-10 text_input">
                    <label for="subject">Asunto</label>
                    <input type="text" name="subject" placeholder="{{ $errors->has('subject') ? $errors->first('subject') : 'Escribe aqui tu consulta' }}" id="subject" class="{{ $errors->has('subject') ? 'is-invalid' : ''}}" value="{{ old('subject') }}">
                </div>
{{--                Campo de mensaje--}}
{{--                <div class="col-xs-10">--}}
{{--                    <label for="message">Mensaje</label>--}}
{{--                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Escribe aquí tu consulta" class="{{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') }}</textarea>--}}
{{--                    @if ($errors->has('message'))--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('message') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="col-xs-10 switch_input">
                    <label aria-label="terms">Acepto los <a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">términos y condiciones</a> así como también el <a href="#" data-toggle="modal" data-target="#GDPRModal">Reglamento General de Protección de datos</a></label>

                    <label for="terms" class="switch">
                        <input id="terms" name="terms" type="checkbox">
                        <i class="checkbox_slider fas checkbox_slider--rounded"></i>
                    </label>
                    @if ($errors->has('terms'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('terms') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-10">
                    <div class="g-recaptcha" data-sitekey="6LcIhqIUAAAAAPPWaly2yJAAadIjMISICA_9rQy3"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-10">
                    <button type="submit" class="footer_submit">Submit</button>
                    <button type="reset" class="footer_reset">Cancel</button>
                </div>
            </form>

            {{--Social Media Links--}}
            <div class="footer_social-media col-sm-12">
                <div class="footer_title">
                    <h3>Síguenos</h3>
                </div>
                <ul class="footer_sublist">
                    <li class="sublist_item">
                        <label><a href="https://www.facebook.com/intuuchina" target="_blank"><i class="fab fa-facebook-square">Facebook</i></a></label>
                    </li>
                    <li class="sublist_item">
                        <label><a href="https://www.instagram.com/intuuchina/" target="_blank"><i class="fab fa-instagram">Instagram</i></a></label>
                    </li>
                    <li class="sublist_item">
                        <label><a href="https://www.linkedin.com/company/intuuchina" target="_blank"><i class="fab fa-linkedin">Linkedin</i></a></label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer_footer">
            {{--Terms and conditions & Signatures--}}
            <div class="footer_documentation col-sm-12">
                <p>IntuuChina Copyright &copy; 2019 Todos los derechos reservados </p>
                <span class="footer_documentation_signature">
                    <p>Made with love &hearts; by <a href="http://factoriaf5.org"></p>
                    <img src="{{ asset('storage/images/logo_factoriaf5.png') }}" alt="Logo de factoriaF5">
                </span>
                <p>
                    <a href="#" data-toggle="modal" data-target="#privacyPolicy">Política de privacidad</a> | <a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">Terminos y condiciones</a>
                </p>
            </div>
        </div>
    </div>
</footer>

@include('partials._terms-and-conditions')

@include('partials._gdpr')

@include('partials._privacy-policy')
