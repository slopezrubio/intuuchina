<div class="bottom-navigation">
    <ul>
        @if(isset($items))
            @foreach($items as $key => $item)
                <li class="bottom-navigation__item">
                    @if(!$loop->first && !$loop->last)
                        {{ $slot }}
                    @else

                    @endif
                    <!-- TODO -->
                </li>
            @endforeach
        @else
            <li class="bottom-navigation__item">

            </li>
        @endif
    </ul>
</div>