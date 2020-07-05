<form method="POST" action="{{ route('admin.new-fee') }}" id="create-fee" class="extended-form">
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

    @if(session('status') !== null)
        <div class="row">
            <div class="success-message col-12">
                <span>
                    <i class="fas fa-check"></i>
                    {{ __('validation.custom.forms.admin.new-fee.completed') }}
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
            @component('components.inputs.select', ['options' => App\FeeType::getOptions()])
                @slot('name', 'fee_type')
                @if(old('fee_type') !== null)
                    @slot('value', old('fee_type'))
                @endif
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
                @slot('value', old('amount'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="unitFieldset" style="{{ App\Fee::all()->first()->value === 'unit_rate' || old('fee_type') === 'unit_rate' ? '' : 'display:none' }}">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'unit'])
                {{ __('Unit of Measure') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'unit')
                @slot('value', old('unit'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="minimumFieldset" style="{{ App\Fee::all()->first()->value === 'unit_rate' || old('fee_type') === 'unit_rate' ? '' : 'display:none' }}">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'name'])
                {{ __('Minimum Qty.') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'minimum')
                @slot('value', old('minimum'))
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
                @slot('value', array_key_first(Tax::getOptions()))
            @endcomponent
        </div>
    </div>

    @if (old('fee_type') === null)

        <div class="form-group row" id="industryFieldset" style="{{
            (in_array('internship', array_keys(App\Program::getOptions(App\FeeType::all()->first()->programs))) || in_array('inter_relocat', array_keys(App\Program::getOptions(App\FeeType::all()->first()->programs)))) ? '' : 'display:none'
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
            (in_array('study', array_keys(App\Program::getOptions(App\FeeType::all()->first()->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label', __('Study Chinese Via'))
            @endcomponent
        </div>

        <div class="form-group row" id="universityFieldset" style="{{
            (in_array('university', array_keys(App\Program::getOptions(App\FeeType::all()->first()->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'university'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label',  __('University'))
            @endcomponent
        </div>

    @else

        <div class="form-group row" id="industryFieldset" style="{{
            (in_array('internship', array_keys(App\Program::getOptions(App\FeeType::where('value', old('fee_type'))->first()->programs))) || in_array('inter_relocat', array_keys(App\Program::getOptions(App\FeeType::where('value', old('fee_type'))->first()->programs)))) ? '' : 'display:none'
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
            (in_array('study', array_keys(App\Program::getOptions(App\FeeType::where('value', old('fee_type'))->first()->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label', __('Study Chinese Via'))
            @endcomponent
        </div>

        <div class="form-group row" id="universityFieldset" style="{{
            (in_array('university', array_keys(App\Program::getOptions(App\FeeType::where('value', old('fee_type'))->first()->programs)))) ? '' : 'display:none'
        }}">
            @component('components.inputs.checkbox-group', [
                'inputs' => App\Category::getOptionsFrom('App\Program', 'university'),
                'checked' => [],
            ])
                @slot('name', 'categories')
                @slot('label',  __('University'))
            @endcomponent
        </div>

    @endif

    <div class="form-group row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4">
            @component('components.inputs.shutter-button')
                @slot('type', 'submit')
                @slot('content', __('Save'))
            @endcomponent
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            @component('components.inputs.shutter-button')
                @slot('type', 'reset')
                @slot('content', __('Cancel'))
            @endcomponent
        </div>
    </div>

</form>