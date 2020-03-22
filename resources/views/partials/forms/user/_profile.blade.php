<form class="card extended-form" action="{{ route('register') }}">
    @csrf
    <div class="form-group row">
        <div class="p-0 col-12 col-md-6 form-group d-flex flex-wrap flex-md-row">
            <div class="col-12 col-md-4">
                @component('components.inputs.label', ['name' => 'name'])
                    {{ __('Name') }}
                @endcomponent
            </div>
            <div class="col-12 col-md-8">
                @component('components.inputs.text')
                    @slot('name', 'name')
                    @slot('value', Auth::user()->name)
                @endcomponent
            </div>
        </div>
        <div class="p-0 col-12 col-md-6 form-group d-flex flex-wrap flex-md-row">
            <div class="col-12 col-md-4">
                @component('components.inputs.label', ['name' => 'surnames'])
                    {{ __('Surnames') }}
                @endcomponent
            </div>
            <div class="col-12 col-md-8">
                @component('components.inputs.text')
                    @slot('name', 'surnames')
                    @slot('value', Auth::user()->surnames)
                @endcomponent
            </div>
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
                @slot('value', Auth::user()->phone_number['number'])
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
                @slot('value', Auth::user()->nationality)
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
            @component('components.inputs.select', ['options' => __('content.programs')])
                @slot('name', 'program')
                @slot('value', Auth::user()->program)
            @endcomponent
        </div>
    </div>

    <div class="form-group row {{ auth()->user()->industry === null ? 'hidden' : ''}}" id="industryFieldset" style="{{ session()->has('preferences.industry') ? 'display: block' : '' }}">
        @component('components.inputs.checkbox-group', ['inputs' => __('content.industries')])
            @slot('name', 'industry')
            @slot('label', __('content.industry'))
        @endcomponent
    </div>

    <div class="form-group row {{ auth()->user()->study === null ? 'hidden' : ''}}" id="studyFieldset" style="{{ session()->has('preferences.study') ? 'display: block' : '' }}">
        @component('components.inputs.checkbox-group', ['inputs' => __('content.courses')])
            @slot('name', 'study')
            @slot('label', __('content.study chinese via'))
        @endcomponent
    </div>

    <div class="form-group row {{ auth()->user()->university === null ? 'hidden' : ''}}" id="universityFieldset" style="{{ session()->has('preferences.university') ? 'display: block' : '' }}">
        @component('components.inputs.checkbox-group', ['inputs' => __('content.universities')])
            @slot('name', 'university')
            @slot('label',  __('content.university'))
        @endcomponent
    </div>

    <div class="form-group row">
        @component('components.inputs.file')
            @slot('name', 'cv')
            @slot('label', __('content.cv'))
            @slot('muted',  __('auth.allowed cv document formats'))
        @endcomponent
    </div>

    <div class="form-group row justify-content-center">
        @component('components.inputs.shutter-button')
            @slot('type', 'submit')
            @slot('content', __('auth.register') )
        @endcomponent
        @component('components.inputs.shutter-button')
            @slot('type', 'reset')
            @slot('content', __('auth.reset'))
        @endcomponent
    </div>
</form>