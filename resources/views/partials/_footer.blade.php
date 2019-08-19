<footer>

    <div class="container-fluid footer">
        <div class="footer_header">
            {{--Web Map--}}
            <div class="footer_web-map col-sm-12">
                <div class="footer_title">
                    <h3>{{ __('content.website map') }}</h3>
                </div>
                <div class="footer_web-map_items">
                    <div>
                        <h4 class="footer_subtitle">{{ __('content.internship') }}</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="{{ route('offers') }}">{{ __('links.job offers') }}</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">{{ __('content.learn chinese') }}</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="{{ url('/learn/1') }}">{{ __('links.in-person') }}</a></li>
                            <li class="web-map_item"><a href="{{ url('/learn/2') }}">{{ __('links.on-line') }}</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">{{ __('content.university') }}</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="#">{{ __('links.master of business administration acronym') }}</a></li>
                            <li class="web-map_item"><a href="#">{{ __('links.master of international business acronym') }}</a></li>
                            <li class="web-map_item"><a href="#">{{ __('links.other studies') }}</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer_subtitle">{{ __('content.why intuuchina') }}</h4>
                        <ul class="web-map_list">
                            <li class="web-map_item"><a href="#">{{ __('links.whyus') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{--Contact form--}}
            <form action="{{ route('mail') }}" method="post" class="footer_contact_form col-sm-12">
                @csrf
                <div class="footer_title">
                    <h3>{{ __('content.contact us') }}</h3>
                </div>
                <div class="col-xs-10 text_input">
                    <label for="name">{{ __('content.name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ $errors->has('name') ? $errors->first('name') : __('content.name placeholder') }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                </div>
                <div class="col-xs-10 text_input">
                    <label for="email">{{ __('content.mail') }}</label>
                    <input type="text" name="email" id="email" placeholder="{{ $errors->has('email') ? $errors->first('email') : __('content.email placeholder') }}" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                </div>
                <div class="col-xs-10 text_input">
                    <label for="subject">{{ __('content.subject') }}</label>
                    <input type="text" name="subject" placeholder="{{ $errors->has('subject') ? $errors->first('subject') : __('content.subject placeholder') }}" id="subject" class="{{ $errors->has('subject') ? 'is-invalid' : ''}}" value="{{ old('subject') }}">
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
                    <label aria-label="terms">{{ __('content.i accept the')[0] }}<a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">{{ __('links.terms and conditions') }}</a>{{ __('content.i accept the')[1] }}<a href="#" data-toggle="modal" data-target="#GDPRModal">{{ __('links.general data protection regulation') }}</a></label>
                    @include('partials._terms-and-conditions')

                    @include('partials._gdpr')

                    @include('partials._privacy-policy')

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
                    <button type="submit" class="footer_submit">{{ __('content.submit') }}</button>
                    <button type="reset" class="footer_reset">{{ __('content.cancel') }}</button>
                </div>
            </form>

            {{--Social Media Links--}}
            <div class="footer_social-media col-sm-12">
                <div class="footer_title">
                    <h3>{{ __('content.follow us') }}</h3>
                </div>
                <ul class="footer_sublist">
                    <li class="sublist_item">
                        <label><a href="https://www.facebook.com/intuuchina" target="_blank"><i class="fab fa-facebook-square">{{ __('links.facebook') }}</i></a></label>
                    </li>
                    <li class="sublist_item">
                        <label><a href="https://www.instagram.com/intuuchina/" target="_blank"><i class="fab fa-instagram">{{ __('links.instagram') }}</i></a></label>
                    </li>
                    <li class="sublist_item">
                        <label><a href="https://www.linkedin.com/company/intuuchina" target="_blank"><i class="fab fa-linkedin">{{ __('links.linkedin') }}</i></a></label>
                    </li>
                </ul>
            </div>

        </div>
        <div class="footer_footer">
            {{--Terms and conditions & Signatures--}}
            <div class="footer_documentation col-sm-12">
                <p>{{ __('content.copyright') }}</p>
                <span class="footer_documentation_signature">
                    <p>{{ __('content.made with love by ') }}<a href="http://factoriaf5.org"></p>
                    <img src="{{ asset('storage/images/logo_factoriaf5.png') }}" alt="Logo de factoriaF5">
                </span>
                <p>
                    <a href="#" data-toggle="modal" data-target="#privacyPolicy">{{ __('links.privacy policy') }}</a> | <a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">{{ __('links.terms and conditions') }}</a>
                </p>
            </div>
        </div>
    </div>
</footer>