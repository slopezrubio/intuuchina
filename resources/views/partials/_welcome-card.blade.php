@if(Auth::user()->type === 'user')
    <div class="container user-card">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

    {{--                        <div class="alert alert-success" role="alert">--}}
    {{--                            {{ session('status') }}--}}
    {{--                        </div>--}}
                    @if (session('status') === 'created')
                        @include ('partials/forms/dialog-welcome-user')
                    @else
                        @include ('partials/forms/dialog-box-' . $status)
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif