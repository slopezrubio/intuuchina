<form method="POST" action="{{ route('admin.new-fee', ['fee' => $fee->id]) }}" id="edit-fee" class="extended-form">
    @csrf

    @if($errors->any())
        <div class="row">
            <div class="error-message col-12">
                <span>
                    <i class="fas fa-times"></i>
                    {{ __('validation.custom.forms.admin.new-fee.invalid') }}
                </span>
            </div>
        </div>
    @endif

    @if(session('status') !== 'null')
        <div class="row">
            <div class="success-message col-12">
                <span>
                    <i class="fas fa-check"></i>
                    {{ session('status') }}
                </span>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'name'])
                {{ __('Name') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'name')
                @if(old('name') !== null)
                    @slot('value', old('name'))
                @endif
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'heading'])
                {{ __('Heading') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'heading')
                @if(old('heading') !== null)
                    @slot('value', old('heading'))
                @endif
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
            @component('components.inputs.select', ['options' => __('content.industries')])
                @slot('name', 'industry')
                @if(old('industry') !== null)
                    @slot('value', old('industry'))
                @endif
            @endcomponent
        </div>
    </div>

</form>