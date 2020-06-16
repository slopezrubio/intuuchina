@component('components.banner')
    @slot('variant', 'success')
    @slot('text', trans_choice('content.paid user', intval(isset($receipt_url))))

    @slot('action')
        @if(Auth::user()->invoices()->first() !== null)
            <div class="col-12 col-md-8 p-0">
                @component('components.inputs.cta-button', ['variant' => 'primary'])
                    @slot('name', 'billing')
                    @slot('id', 'billing')
                    @slot('href', Auth::user()->invoices()->first()->invoice_pdf)
                    @slot('fas', 'file-alt')
                    @slot('content', __('See Billing'))
                @endcomponent
            </div>
        @endif
    @endslot
@endcomponent