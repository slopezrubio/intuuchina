<form action="{{ route('password.update') }}" id="change-password" class="extended-form" method="POST">
    @csrf

    @if(session()->get('status') !== null)
        <div class="row">
            <div class="success-message col-12">
                <span>
                    <i class="fas fa-check"></i>
                    {{ session()->get('status') }}
                </span>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'password'])
                {{ __('Current Password') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'current_password')
                @slot('id', 'current-password')
                @slot('type', 'password')
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'password'])
                {{ __('New Password') }}
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
                @slot('content', __('Change Password') )
            @endcomponent
        </div>
    </div>

</form>