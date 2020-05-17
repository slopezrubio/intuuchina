<section class="arrow-slider arrow-slider__holder" {!! isset($id) ? 'id='.$id.'Slider' : ''  !!}>
    <div class="arrow-slider__carousel">
        @foreach($slides as $key => $slide)
            @if (isset($visible))
                @if($visible['next'] === null && $visible['previous'] !== null)
                    @switch($slide->id)
                        @case($visible['previous']->id)
                            <div class="arrow-slider__slide--left">
                            @break
                        @case($visible['current']->id)
                            <div class="arrow-slider__slide--current">
                            @break
                        @default
                            <div class="arrow-slider__slide">
                            @break
                    @endswitch
                @elseif($visible['previous'] === null && $visible['next'] !== null)
                    @switch($slide->id)
                        @case($visible['next']->id)
                            <div class="arrow-slider__slide--right">
                            @break
                        @case($visible['current']->id)
                            <div class="arrow-slider__slide--current">
                            @break
                        @default
                            <div class="arrow-slider__slide">
                            @break
                    @endswitch
                @elseif($visible['next'] === null && $visible['previous'] === null)
                    <div class="arrow-slider__slide--current">
                @else
                    @switch($slide->id)
                        @case($visible['next']->id)
                            <div class="arrow-slider__slide--right">
                            @break
                        @case($visible['previous']->id)
                            <div class="arrow-slider__slide--left">
                            @break
                        @case($visible['current']->id)
                            <div class="arrow-slider__slide--right">
                            @break
                        @default
                            <div class="arrow-slider__slide">
                            @break
                    @endswitch
                @endif
            @else
                @if($loop->first)
                    <div class="arrow-slider__slide--current">
                @elseif($loop->iteration === 2)
                    <div class="arrow-slider__slide--right">
                @else
                    <div class="arrow-slider__slide">
                @endif
            @endif

            <div class="arrow-slider__slide-header">
                <h2>
                    {{ __('component.arrow.' . $name . '.' . $slide->value. '.heading', [ 'header' => $slide->name ]) }}
                </h2>

                @if(isset($action))
                    @include($action)
                @endif
            </div>
            <p>
                {{ __('component.arrow.' . $name . '.' . $slide->value. '.description') }}
            </p>
        </div>
        @endforeach
    </div>

    <div class="arrow-slider__controllers">
        @foreach($slides as $key => $slide)
            @if(isset($visible))
                <a role="button" tabindex="{{ $loop->index }}" class="{{ $slide->id === $visible['current']->id ? 'selected' : '' }}">
                    <span>{{ __($slide->name) }}</span>
                </a>
            @else
                <a role="button" tabindex="{{ $loop->index }}" class="{{ $loop->first ? 'selected' : '' }}">
                    <span>{{ __($slide->name) }}</span>
                </a>
            @endif
        @endforeach
    </div>
</section>