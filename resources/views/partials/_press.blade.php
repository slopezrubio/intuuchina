<section id="press" class="o-oblique">
    @component('components.sliders.media-slider', ['media' => __('component.media')])
        @slot('title')
            {!! trans('content.what the media think') !!}
        @endslot
    @endcomponent
</section>
