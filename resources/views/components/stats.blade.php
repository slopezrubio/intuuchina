<header class="stats" style="background-image: {{ isset($background_image) ? 'url(' .$background_image. ')' : 'none' }};">
    @include('partials._nav')
    @foreach ($stats as $stat)
        @if ($loop->index % 3 == 0)
            <section class="stats__container">
        @endif
            <article class="stats__item">
               {!! $stat !!}
            </article>
        @if ($loop->iteration === 3)
            </section>
        @endif
    @endforeach
</header>