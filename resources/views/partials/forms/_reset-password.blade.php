<form action="{{ route('password.email') }}" id="reset-password" class="extended-form" method="POST">
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

    <div class="form-group row justify-content-center">
        <div class="col-12 col-sm-8">
            @component('components.inputs.shutter-button')
                @slot('type', 'submit')
                @slot('content', __('Request Password Reset Link') )
            @endcomponent
        </div>
    </div>

</form>