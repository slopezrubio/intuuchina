<form method="POST" action="{{ route('admin.update-fee', ['fee' => $fee->id]) }}" id="edit-fee" class="extended-form">
    @csrf

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'name'])
                {{ __('Name') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'name')
                @slot('value', $fee->name)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'fee_type'])
                {{ __('Fee Type') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' =>  App\FeeType::getOptions()])
                @slot('name', 'fee_type')
                @slot('value', $fee->feeType)
            @endcomponent
        </div>
    </div>

    @if($fee->feeType->value = 'unit_rate')
        <div class="form-group row">
            <div class="col-md-3">
                @component('components.inputs.label', ['name' => 'name'])
                    {{ __('Unit of Measure') }}
                @endcomponent
            </div>
            <div class="col-md-9">
                @component('components.inputs.text')
                    @slot('name', 'unit')
                    @slot('value', $fee->unit)
                @endcomponent
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3">
                @component('components.inputs.label', ['name' => 'name'])
                    {{ __('Minimum Qty.') }}
                @endcomponent
            </div>
            <div class="col-md-9">
                @component('components.inputs.text')
                    @slot('name', 'minimum')
                    @slot('value', $fee->minimum)
                @endcomponent
            </div>
        </div>
    @endif

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'amount'])
                {{ __('Amount') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'amount')
                @slot('value', $fee->amount)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'tax'])
                {{ __('Tax Applied') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' =>  Tax::getOptions()])
                @slot('name', 'tax')
                @slot('value', $fee->jurisdiction)
            @endcomponent
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4">
            @component('components.inputs.shutter-button')
                @slot('type', 'submit')
                @slot('content', __('Save') )
            @endcomponent
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            @component('components.inputs.shutter-button')
                @slot('type', 'reset')
                @slot('content', __('Cancel') )
            @endcomponent
        </div>
    </div>
</form>