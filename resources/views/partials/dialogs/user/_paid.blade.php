@component('components.dialog-box')
    @slot('title', __('Payment Completed'))

    @slot('dialog')
        <div class="col-12">
            @component('components.banner')
                @slot('variant', 'success')
                @slot('text', trans_choice('content.paid user', intval(isset($receipt_url))))
            @endcomponent
        </div>
    @endslot

    @slot('action')
        <div class="col-12 col-sm-4">
            @component('components.inputs.alternative-button')
                @slot('name', 'home')
                @slot('href', route('home'))
                @slot('content', __('Back To Profile'))
            @endcomponent
        </div>
        <div class="col-12 col-sm-8">
            @component('components.inputs.cta-button', ['variant' => 'primary'])
                @slot('name', 'billing')
                @slot('id', 'billing')
                @slot('href', $receipt_url)
                @slot('fas', 'file-alt')
                @slot('content', __('See Billing'))
            @endcomponent
        </div>
    @endslot
@endcomponent