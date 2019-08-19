<section class="sensationalism-stats">
    @foreach (__('content.facts') as $fact)
        <article class="facts">
            <p>{{ $fact['first text'] }}</p>
            <div class="circle">
                <h4 class="count">{{ $fact['number'] }}</h4>
            </div>
            <p>{{ $fact['second text'] }}</p>
        </article>
    @endforeach
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/lib/js_components/whyex.js')}}"></script>