<section id="testimonials">
    @component('components.sliders.people-slider', ['people' => $testimonials])
        @slot('title')
            {!! trans('content.those who have already tried it') !!}
        @endslot
    @endcomponent
</section>