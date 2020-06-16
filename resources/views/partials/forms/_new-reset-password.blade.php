<form action="{{ route('password.update') }}" id="update-password" class="extended-form" method="POST">
    @csrf

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'email'])
                {{ __('E-Mail Address') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'email')
                @slot('value', old('email'))
                @slot('placeholder', __('placeholder.email.default'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'password'])
                {{ __('Password') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'password')
                @slot('type', 'password')
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'password-confirm'])
                {{ __('Confirm Password') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'password_confirmation')
                @slot('id', 'password-confirm')
                @slot('type', 'password')
            @endcomponent
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-12 col-sm-8">
            @component('components.inputs.shutter-button')
                @slot('type', 'submit')
                @slot('content', __('Reset Password') )
            @endcomponent
        </div>
    </div>

</form>