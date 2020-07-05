<div class="infography container">
    @if(isset($items) && count($items) > 0)
        <ol class="step-list">
            @foreach($items as $item)
                <li class="step-list__item">
                    <div class="step-list__item__inner">
                        <div class="content">
                            <div class="body">
                                @if(isset($item['href']))
                                    <a href={{ $item['href'] }}>
                                        <h5>{{ $item['title'] }}</h5>
                                    </a>
                                @else
                                    <h5>{{ $item['title'] }}</h5>
                                @endif
                            </div>
                            @isset($item['icon'])
                                <div class="icon">
                                    <img src="{{ $item['icon']['url'] }}" alt="{{ $item['icon']['alt'] }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ol>
    @endif
</div>