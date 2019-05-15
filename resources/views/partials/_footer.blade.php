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
                            <li class="web-map_item"><a href="#">Ofertas</a></li>
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
            <form action="" class="footer_contact_form col-sm-12">
                <div class="footer_title">
                    <h3>Contact us!</h3>
                </div>
                <div class="col-xs-10 contact_form_input">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Nombre">
                </div>
                <div class="col-xs-10">
                    <label for="email">Correo</label>
                    <input type="text" name="email" id="email" placeholder="Correo">
                </div>
                <div class="col-xs-10">
                    <label for="issue">Asunto</label>
                    <input type="text" name="issue" id="issue">
                </div>
                <div class="col-xs-10">
                    <label for="question">Mensaje</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Escribe aquí tu consulta"></textarea>
                </div>
                <div class="col-xs-10">
                    <label aria-label="terms">Acepto los términos y condiciones</label>
                    <label for="terms" class="switch">
                        <input id="terms" name="terms" type="checkbox">
                        <span class="checkbox_slider checkbox_slider--rounded"></span>
                    </label>
                </div>
                <div class="col-xs-10">
                    <div class="g-recaptcha" data-sitekey="6LcIhqIUAAAAAPPWaly2yJAAadIjMISICA_9rQy3"></div>
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
                        <label><a href="https://twitter.com/intuuchina" target="_blank"><i class="fab fa-twitter-square">Twitter</i></a></label>
                    </li>
                    <li class="sublist_item">
                        <label><a href="https://www.linkedin.com/company/intuuchina" target="_blank"><i class="fab fa-linkedin">Linkedin</i></a></label>
                    </li>
                </ul>
            </div>

        </div>
        <div class="footer_footer col-md-12">
            {{--Terms and conditions & Signatures--}}
            <div class="footer_documentation">
                <p>IntuuChina Copyright &copy; 2019 Todos los derechos reservados </p>
                <p>Made with love &hearts; by <a href="http://factoriaf5.org">Factoria F5</a></p>
                <p><a href="#">Politica de privacidad</a> | <a href="#">Terminos y condiciones</a></p>
            </div>
        </div>
    </div>
</footer>