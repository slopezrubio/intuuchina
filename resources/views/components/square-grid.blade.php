<div class="container square-grid" {{ isset($id) ? 'id='.$id : '' }}>
    @foreach($items as $item)
        <section class="square-grid__square{{ isset($item['color']) ? ' square-grid__square--'.$item['color'] : '' }} {{ isset($item['background-image']) ? ' square-grid__square--backgrounded' : '' }}"
                {{ isset($item['id']) ? 'id='.$item['id'] : '' }} {{ isset($item['background-image']) ? 'style=background-image:url(' . $item['background-image'] . ')' : '' }}>

                <h5 class="square-grid__square-title">
                        {{ $item['title'] }}
                </h5>

                <div class="square-grid__square-body">
                        {!! $item['content'] !!}
                </div>
        </section>

        @if(isset($item['picture']))
                <section class="square-grid__square square-grid__square--covered">
                        <img src="{{ $item['picture']['url'] }}" alt="{{ $item['picture']['alt'] }}">
                </section>
        @endif
    @endforeach
        <div class="square-grid__clearfix"></div>
</div>