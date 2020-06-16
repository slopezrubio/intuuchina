<form class="extended-form" enctype="multipart/form-data" id="edit-user" action="{{ route('user.update-user', ['user' => Auth::user()->id]) }}" method="POST">
    @csrf

    @if($errors->profile->any())
        <div class="row">
            <div class="error-message col-12">
                <span>
                    <i class="fas fa-times"></i>
                    {{ __('validation.custom.forms.profile.invalid') }}
                </span>
            </div>
        </div>
    @endif

    @if(session()->get('status') === 'completed')
        <div class="row">
            <div class="success-message col-12">
                <span>
                    <i class="fas fa-check"></i>
                    {{ __('validation.custom.forms.profile.completed') }}
                </span>
            </div>
        </div>
    @endif

    @status('verified')
        <div class="form-group row">
            <div class="p-0 mb-0 col-12 col-md-6 form-group d-flex flex-wrap flex-md-row">
                <div class="col-12 col-md-4">
                    @component('components.inputs.label', ['name' => 'name'])
                        {{ __('Name') }}
                    @endcomponent
                </div>
                <div class="col-12 col-md-8">
                    @component('components.inputs.text')
                        @slot('name', 'name')
                        @slot('bag', 'profile')
                        @slot('value', $errors->profile->any() ? old('name') : Auth::user()->name)
                    @endcomponent
                </div>
            </div>
            <div class="p-0 col-12 mb-0 col-md-6 form-group d-flex flex-wrap flex-md-row">
                <div class="col-12 col-md-4">
                    @component('components.inputs.label', ['name' => 'surnames'])
                        {{ __('Surnames') }}
                    @endcomponent
                </div>
                <div class="col-12 col-md-8">
                    @component('components.inputs.text')
                        @slot('name', 'surnames')
                        @slot('bag', 'profile')
                        @slot('value', $errors->profile->any() ? old('surnames') : Auth::user()->surnames)
                    @endcomponent
                </div>
            </div>
        </div>
    @endstatus

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'phone-number'])
                {{ __('Phone Number') }}
            @endcomponent
        </div>

        <div class="col-md-9 d-flex p-0">
            @component('components.inputs.phone')
                @slot('name', 'phone_number')
                @slot('bag', 'profile')
                @slot('prefix', $errors->profile->any() ? old('prefix') : Auth::user()->phone_number['prefix'])
                @slot('value',  $errors->profile->any() ? old('phone_number') : Auth::user()->phone_number['number'])
            @endcomponent
        </div>
    </div>

    @status('verified')
        <div class="form-group row">
            <div class="col-md-3">
                @component('components.inputs.label', ['name' => 'nationality'])
                    {{ __('Nationality') }}
                @endcomponent
            </div>
            <div class="col-md-9">
                @component('components.inputs.select', ['options' =>  __('countries.nationalities')])
                    @slot('name', 'nationality')
                    @slot('value', $errors->profile->any() ? old('nationality') : Auth::user()->nationality)
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
                    @slot('value', $errors->profile->any() ? old('program') : Auth::user()->program->value)
                @endcomponent
            </div>
        </div>

        @if (!$errors->profile->any())
            <div class="form-group row" id="industryFieldset"
                 style="{{ (Auth::user()->program->value === 'inter_relocat' || Auth::user()->program->value === 'internship') ? '' : 'display: none'}}">
                @component('components.inputs.checkbox-group', [
                    'inputs' => App\Category::getOptionsFrom('App\Program', 'inter_relocat'),
                    'checked' => Auth::user()->program->value === 'inter_relocat' || Auth::user()->program->value === 'internship' ? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label', __('Industry'))
                @endcomponent
            </div>

            <div class="form-group row" id="studyFieldset"
                 style="{{ (Auth::user()->program->value === 'study') ? '' : 'display: none'}}">
                @component('components.inputs.checkbox-group', [
                    'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                    'checked' =>  Auth::user()->program->value === 'study'? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label', __('Study Chinese Via'))
                @endcomponent
            </div>

            <div class="form-group row" id="universityFieldset"
                 style="{{ (Auth::user()->program->value === 'university') ? '' : 'display: none'}}">

                @component('components.inputs.checkbox-group', [
                    'inputs' =>  App\Category::getOptionsFrom('App\Program', 'university'),
                    'checked' =>  Auth::user()->program->value === 'university'? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label',  __('University'))
                @endcomponent
            </div>

        @elseif($errors->profile->any())

            <div class="form-group row" id="industryFieldset"
                 style="{{ (old('program') === 'inter_relocat' || old('program') === 'internship') ? '' : 'display: none'
                    }}">
                @component('components.inputs.checkbox-group', [
                    'inputs' => App\Category::getOptionsFrom('App\Program', 'inter_relocat'),
                    'checked' => Auth::user()->program->value === 'inter_relocat' || Auth::user()->program->value === 'internship' ? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label', __('Industry'))
                @endcomponent
            </div>

            <div class="form-group row" id="studyFieldset"
                 style="{{ (old('program') === 'study') ? '' : 'display: none'}}">
                @component('components.inputs.checkbox-group', [
                    'inputs' => App\Category::getOptionsFrom('App\Program', 'study'),
                    'checked' =>  Auth::user()->program->value === 'study'? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label', __('Study Chinese Via'))
                @endcomponent
            </div>

            <div class="form-group row" id="universityFieldset"
                 style="{{ (old('program') === 'university') ? '' : 'display: none'}}">
                @component('components.inputs.checkbox-group', [
                    'inputs' => App\Category::getOptionsFrom('App\Program', 'university'),
                    'checked' =>  Auth::user()->program->value === 'university' ? array_column(App\Category::getOptionsFrom('App\User', Auth::user()->id), 'id') : [],
                ])
                    @slot('name', 'categories')
                    @slot('label', __('University'))
                @endcomponent
            </div>
        @endif


        <div class="form-group row"
             style="{{ (old('program') !== null && old('program') === 'study' && $errors->profile->any()) ||
                        (old('program') === null && !$errors->profile->any() && Auth::user()->program->value === 'study') ? 'display:none' : ''
                    }}">

            <div class="col-md-3">
                @component('components.inputs.label', ['name' => 'cv'])
                    {{ __('CV') }}
                @endcomponent
            </div>

            <div class="col-md-9">
                @component('components.inputs.file')
                    @slot('name', 'cv')
                    @slot('bag', 'profile')
                    @slot('muted',  __('auth.allowed cv document formats'))
                @endcomponent
            </div>
        </div>
    @endstatus

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
                @slot('content', __('Cancel'))
            @endcomponent
        </div>
    </div>
</form>