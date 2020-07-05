
@isset($data['billings'])
    <div class="col-12">
        @foreach($data['billings'] as $billing)
            @component('components.inputs.download-file')
                @slot('content', $billing->description)
                @slot('href', $billing->invoice_pdf)
                @slot('info', App\Program::where('value', $billing->metadata->program)->first()->name)
            @endcomponent
        @endforeach
    </div>
@else
    <p>
        <strong>{{ __('content.no such item has been found', ['item' => 'billings']) }}</strong>
    </p>
@endisset


@isset($data['billings'])
    {!!  $data['billings']->links('vendor.pagination.semantic-ui') !!}
@endisset
