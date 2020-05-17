<form id="edit-user" method="POST" enctype="multipart/form-data" action="{{ route('admin.update-user', ['offer' => $user->id]) }}" class="extended-form">
    @csrf
    <div class="form-group row">
        @component('components.inputs.radio-chips', [
            'inputs' => App\Status::getOptions(),
            'checked' => $user->status->value !== null ? [$user->status->value] : [],
        ])

            @slot('name', 'status')

        @endcomponent
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'name'])
                {{ __('Name') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'name')
                @slot('value', $user->name)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'surnames'])
                {{ __('Surnames') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'surnames')
                @slot('value', $user->surnames)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'phone-number'])
                {{ __('Phone Number') }}
            @endcomponent
        </div>
        <div class="col-md-9 d-flex p-0">
            @component('components.inputs.phone')
                @slot('name', 'phone_number')
                @slot('prefix', $user->phone_number['prefix'])
                @slot('value', $user->phone_number['number'])
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'nationality'])
                {{ __('Nationality') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' =>  __('countries.nationalities')])
                @slot('name', 'nationality')
                @slot('value', $user->nationality)
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="programFieldset">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'program'])
                {{ __('Program') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' => App\Program::getOptions()])
                @slot('name', 'program')
                @slot('value', old('program') !== null ? old('program') : $user->program->value)
            @endcomponent
        </div>
    </div>

    <div class="form-group row" id="industryFieldset"
         style="{{ ($user->program->value === 'inter_relocat' || $user->program->value === 'internship') ? '' : 'display: none'}}">
        @component('components.inputs.checkbox-group', [
            'inputs' => App\Category::getOptionsFrom('App\Program', 'inter_relocat'),
            'checked' => $user->program->value === 'inter_relocat' || $user->program->value === 'internship' ? array_column(App\Category::getOptionsFrom('App\User', $user->id), 'id') : [],
        ])
            @slot('name', 'categories')
            @slot('label', __('Industry'))
        @endcomponent
    </div>

    <div class="form-group row" id="studyFieldset"
         style="{{ $user->program->value === 'study' ? '' : 'display: none' }}">
        @component('components.inputs.checkbox-group', [
            'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
            'checked' =>  $user->program->value === 'study'? array_column(App\Category::getOptionsFrom('App\User', $user->id), 'id') : [],
        ])
            @slot('name', 'categories')
            @slot('label', __('Study Chinese Via'))
        @endcomponent
    </div>

    <div class="form-group row" id="universityFieldset"
         style="{{ $user->program->value === 'university' ? '' : 'display: none' }}">
        @component('components.inputs.checkbox-group', [
            'inputs' =>  App\Category::getOptionsFrom('App\Program', 'university'),
            'checked' =>  $user->program->value === 'study'? array_column(App\Category::getOptionsFrom('App\User', $user->id), 'id') : [],
        ])
            @slot('name', 'categories')
            @slot('label',  __('University'))
        @endcomponent
    </div>


    <div class="form-group row"
         style="{{ (old('program') !== null && old('program') === 'study') ||
                    (old('program') === null && $user->program->value === 'study') ? 'display:none' : ''
                }}">

        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'cv'])
                {{ __('CV') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.file')
                @slot('name', 'cv')
                @slot('muted',  __('auth.allowed cv document formats'))
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