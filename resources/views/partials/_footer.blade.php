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
                            <li class="web-map_item"><a href="#">Online</a></li>
                            <li class="web-map_item"><a href="#">Presencial</a></li>
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

                    <!-- Terms and Conditions Modal -->
                    <div class="modal fade" id="termsAndConditionsModal" tabindex="-1" role="dialog" aria-labelledby="termsAndConditionsModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="termsAndConditionsModalTitle">Términos y condiciones</h5>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- GDPR Modal -->
                    <div class="modal fade" id="GDPRModal" tabindex="-1" role="dialog" aria-labelledby="GDPRModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="GDPRModalTitle">Reglamento General de Protección de datos</h5>
                            </div>
                        <div class="modal-body">
                            En primer lugar le agradecemos el interés que ha mostrado por dirigirse IntuuChina Ltd. al facilitarnos sus datos e informacion.<br><br>

                            Le informamos que, de conformidad con la normativa sobre protección de datos, sus datos serán objeto de tratamiento por IntuuChina Ltd. como Responsable del mismo con la finalidad de gestionar su currículum para la selección de personal. Si su perfil no se ajustase a los requisitos pertinentes en los vigentes procesos de selección procederemos a conservar sus datos para futuros procesos que sí se ajusten a su perfil, salvo que Vd. nos manifieste lo contrario.<br><br>

                            Contamos con su consentimiento para el tratamiento de los datos que nos ha facilitado de forma voluntaria, libre e informada a efectos de participar en los procesos de selección de la organización.<br><br>

                            Por otro lado, queremos comunicarle que no cederemos sus datos a terceros, salvo autorización expresa u obligación legal. Tampoco están previstas transferencias internacionales a otros países.<br><br>

                            Podrá ejercer sus derechos de acceso, rectificación, supresión, oposición, limitación del tratamiento, portabilidad, transparencia en la información y a no ser objeto de decisiones individualizadas automatizadas (incluida la elaboración de perfiles),  comunicándolo por escrito, mediante el envío de un correo electrónico a: info@intuuchina.com<br><br>

                            Para más información sobre nuestra Política de Privacidad, puede consultar el siguiente link: www.intuuchina.com<br><br>

                            Sin otro particular, aprovechamos la ocasión para enviarle un cordial saludo.<br><br>

                            Atentamente,<br><br>

                            INTUUUCHINA Ltd<br>
                        </div>
                        </div>
                    </div>
                    </div>

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
                <p><a href="{{ url('/privacy-policy') }}">Politica de privacidad</a> | <a href="{{ route('terms&conditions') }}">Terminos y condiciones</a></p>
            </div>
        </div>
    </div>
</footer>