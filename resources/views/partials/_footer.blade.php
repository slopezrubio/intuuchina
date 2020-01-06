<footer>
    @include('partials._terms-and-conditions')

    @include('partials._gdpr')

    @include('partials._privacy-policy')

    <div class="container-fluid footer">
        <div class="footer_header">
            {{--Web Map--}}
            <div class="footer_web-map col-sm-12">
                <div class="footer_title">
                    <h3>{{ __('content.website map') }}</h3>
                </div>
                <div class="footer_web-map_items">
                    @if (!empty(__('links.webmap')))
                        @foreach (__('links.webmap') as $title => $section)
                            @if (!empty($section))
                                <div>
                                    <h4 class="footer_subtitle">{{ $section['heading'] }}</h4>
                                    <ul class="web-map">
                                    @foreach ($section['options']() as $key => $item)
                                        <li class="web-map_item">
                                        @switch($item['method'])
                                            @case('POST')
                                                <form action="{{ $item['url'] }}" method="{{ $item['method'] }}">
                                                    @csrf
                                                    <input type="hidden" name="{{ $title }}" value="{{ $key }}">
                                                    <a href="#">
                                                        <button type="submit">{{ $item['text'] }}</button>
                                                    </a>
                                                </form>
                                                @break
                                            @case('GET')
                                                <a href="{{ $item['url'] }}">
                                                    {{ $item['text'] }}
                                                </a>
                                                @break
                                        @endswitch
                                        </li>
                                        <li class="web-map_item">

                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    @endif
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
                <div class="col-xs-10">
                    <label aria-label="terms">{!! trans('content.i accept the') !!}</label>

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
                @if(!empty(__('links.social')))
                    <div class="footer_title">
                        <h3>{{ __('content.follow us') }}</h3>

                    </div>
                    <ul class="footer_sublist">
                    @foreach(__('links.social') as $key => $media)
                        <li class="sublist_item">
                            <label>
                                <a href="{{ $media['url'] }}" target="_blank">
                                    <i class="fab fa-{{ $media['square'] ? $key . '-square' : $key }}">{{ $media['text'] }}</i>
                                </a>
                            </label>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>

        </div>
        <div class="footer_footer">
            {{--Terms and conditions & Signatures--}}
            <div class="footer_documentation col-sm-12">
                <p>{{ __('content.copyright') }}</p>
                <span class="footer_documentation_signature">
                    <p>{{ __('content.made with love by ') }}</p>
                    <a href="http://factoriaf5.org"><img src="{{ asset('storage/images/logo_factoriaf5.png') }}" alt="Logo de factoriaF5"></a>
                </span>
                <p>
                    <a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">{!! trans('links.terms and conditions') !!}</a>
                </p>
            </div>
        </div>
    </div>
</footer>