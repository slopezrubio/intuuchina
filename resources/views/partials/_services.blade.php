    <section>
    <div class="triangle"></div>
    <div class="services">
        <div class="service_card" id="s_internship">
            <div class="service_card_container">
                <div class="service_card_header">
                    <h3 class="service_card_title">{{ __('content.internship') }}</h3>
                </div>
                <div class="service_card_body">
                    <p class="service_card_info">
                        {{ __('content.internship service text') }}
                    </p>
                </div>
                <div class="service_card_footer">
                    <a href="{{ url('/internship') }}" class="cta">{{ __('content.see more') }}</a>
                </div>
            </div>
        </div>

        <div class="service_card" id="s_university">
            <div class="service_card_container">
                <div class="service_card_header">
                    <h3 class="service_card_title">{{ __('content.university') }}</h3>
                </div>
                <div class="service_card_body">
                    <p class="service_card_info">
                        {{ __('content.university service text') }}
                    </p>
                </div>
                <div class="service_card_footer">
                    <a href="{{ url('/university') }}" class="cta">{{ __('content.see more') }}</a>
                </div>
            </div>
        </div>

        <div class="service_card" id="s_learn">
            <div class="service_card_container">
                <div class="service_card_header">
                    <h3 class="service_card_title">{{ __('content.learn chinese') }}</h3>
                </div>
                <div class="service_card_body">
                    <p class="service_card_info">
                        {{ __('content.learn chinese service text') }}
                    </p>
                </div>
                <div class="service_card_footer">
                    <a href="{{ url('/learn') }}" class="cta">{{ __('content.see more') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
