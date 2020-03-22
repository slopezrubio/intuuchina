<div class="c-info-box c-info-box--group">
    @foreach($services as $key => $service)
        <div class="c-info-box__container container-fluid col-12 {{ $loop->odd && $loop->last ? 'col-md-12' : 'col-md-6' }} {{ count($services) % 3 === 0 ? 'col-lg-4' : '' }}" style="{{ isset($service['background']) ? 'background-image:url(' . $service['background'] . ')' : '' }}">
            <div class="c-info-box__box">
                <div class="c-info-box__box-header">
                    <h3 class="c-info-box__box-title">
                        {{ $service['title'] }}
                    </h3>
                </div>
                <div class="c-info-box__box-body">
                    <p>
                        {{ $service['description'] }}
                    </p>
                </div>
                @if(isset($service['href']))
                    <div class="c-info-box__box-footer d-flex justify-content-center">
                        @component('components.inputs.cta-button',
                        [
                            'href' => $service['href'],
                            'content' => __('content.see more'),
                        ])
                            @slot('variant', 'primary')
                        @endcomponent
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>