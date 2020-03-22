<div class="social-media {{ isset($variant) ? 'social-media--' . $variant : '' }}">
    @if(!empty(__('component.social')))
        <ul class="social-media__list">
            @foreach(__('component.social') as $key => $media)
                <li class="social-media__list-item">
                    <a href="{{ $media['url'] }}" target="_blank">
                        <i class="fab fa-{{ $media['square'] ? $key . '-square' : $key }}"></i>
                        <span>{{ $media['text'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>