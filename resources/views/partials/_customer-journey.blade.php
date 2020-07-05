{{--<section class="infographic">--}}
{{--    <div class="customer-journey">--}}
{{--        <img src="{{ __('pictures.customer journey vertical.url') }}" alt="{{ __('pictures.customer journey alt') }}">--}}
{{--    </div>--}}
{{--</section>--}}

<section id="customer-journey">
    @component('components.infography', ['items' => __('component.infographies.customer-journey')])

    @endcomponent
</section>
