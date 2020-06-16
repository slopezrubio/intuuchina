<div class="breadcrumb-chunks">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-10">
                <ul>
                    <li>
                        <a href="{{ url('/') }}"><span class="fas fa-home"></span></a>
                    </li>
                    @if(isset($links))
                        @foreach(__($links) as $link)
                            <li>
                                <a href="{{ $link['href'] }}"><span class="icon icon-home">{{ $link['content'] }}</span></a>
                            </li>

                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

