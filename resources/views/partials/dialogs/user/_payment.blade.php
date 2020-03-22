@component('components.dialog-box')
    @slot('title', __('Payment Details'))

    @slot('actions')
        <div class="col-12 dialog-box__actions--main">
            @include('partials.forms.user._study-payment')
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