<form method="POST" action="{{ route('admin.update-fee', ['fee' => $fee->id]) }}" id="edit-fee" class="extended-form">
    @csrf

    @if($errors->any())
        <div class="row">
            <div class="error-message col-12">
                <span>
                    <i class="fas fa-times"></i>
                    {{ __('validation.custom.forms.admin.edit-fee.invalid') }}
                </span>
            </div>
        </div>
    @endif

    @if(session()->get('status') === 'completed')
        <div class="row">
            <div class="success-message col-12">
                <span>
                    <i class="fas fa-check"></i>
                    {{ __('validation.custom.forms.admin.edit-fee.completed') }}
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
                @slot('value', old('name') !== null ? old('name') : $fee->name)
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
                @slot('value', old('heading') !== null ? old('heading') : $fee->heading)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'amount'])
                {{ __('Amount') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'amount')
                @slot('value', old('amount') !== null ? old('amount') : $fee->amount)
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="unitFieldset" style="{{ $fee->value === 'unit_rate' || old('fee_type') === 'unit_rate' ? '' : 'display:none' }}">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'unit'])
                {{ __('Unit of Measure') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'unit')
                @slot('value', old('unit') !== null ? old('unit') : $fee->unit)
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="minimumFieldset" style="{{ $fee->value === 'unit_rate' || old('fee_type') === 'unit_rate' ? '' : 'display:none' }}">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'minimum'])
                {{ __('Minimum Qty.') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'minimum')
                @slot('value', old('minimum') !== null ? old('minimum') : $fee->minimum)
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
                    @slot('value', old('tax') !== null ? old('tax') : $fee->jurisdiction)
                @endcomponent
            </div>
        </div>

    @empty(old())

        <div class="form-group row" id="industryFieldset" style="{{
            (in_array('internship', array_keys(App\Program::getOptions($fee->feeType->programs))) || in_array('inter_relocat', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
         }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'inter_relocat'),
                'checked' => array_column(App\Category::getOptions($fee->categories), 'id'),
            ])
                @slot('name', 'categories')
                @slot('label', __('Industry'))
            @endcomponent
        </div>

        <div class="form-group row" id="studyFieldset" style="{{
            (in_array('study', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                'checked' => array_column(App\Category::getOptions($fee->categories), 'id'),
            ])
                @slot('name', 'categories')
                @slot('label', __('Study Chinese Via'))
            @endcomponent
        </div>

        <div class="form-group row" id="universityFieldset" style="{{
            (in_array('university', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'university'),
                'checked' => array_column(App\Category::getOptions($fee->categories), 'id'),
            ])
                @slot('name', 'categories')
                @slot('label',  __('University'))
            @endcomponent
        </div>
    @else

        {{ var_dump(old('categories')) }}

        <div class="form-group row" id="industryFieldset" style="{{
            (in_array('internship', array_keys(App\Program::getOptions($fee->feeType->programs))) || in_array('inter_relocat', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
         }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'inter_relocat'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label', __('Industry'))
            @endcomponent
        </div>

        <div class="form-group row" id="studyFieldset" style="{{
            (in_array('study', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                'checked' =>                          [],
            ])
                @slot('name', 'categories')
                @slot('label', __('Study Chinese Via'))
            @endcomponent
        </div>

        <div class="form-group row" id="universityFieldset" style="{{
            (in_array('university', array_keys(App\Program::getOptions($fee->feeType->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'university'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label',  __('University'))
            @endcomponent
        </div>
    @endempty



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