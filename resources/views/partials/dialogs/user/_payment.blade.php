@component('components.dialog-box')
    @slot('title', __('Payment Details'))

    @slot('action')
        <div class="col-12 dialog-box__actions--main">
            @include('partials.forms.user._'.Str::kebab(Str::studly(Auth::user()->program->feeType->value)))
        </div>
    @endslot

    @slot('footer')
        <ul class="col-12 dialog-box__list">
            <li>
                {!! __('content.are you in doubt') !!}
            </li>
        </ul>
    @endslot
@endcomponent