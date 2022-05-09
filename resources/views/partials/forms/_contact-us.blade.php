<form action="{{ route('contact.form') }}" method="post" class="contact-form contact-form--footer">
    @csrf
    <div class="form-group row">
        <div class="col-12 col-md-3">
            @component('components.inputs.label', ['name' => 'name', 'bag' => 'contact'])
                {{ __('Name') }}
            @endcomponent
        </div>
        <div class="col-12 col-md-9">
            @component('components.inputs.text')
                @slot('bag', 'contact')
                @slot('name', 'name')
                @slot('value', old('name'))
                @slot('placeholder', __('placeholder.name.default'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'email', 'bag' => 'contact'])
                {{ __('E-Mail Address') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'email')
                @slot('bag', 'contact')
                @slot('value', old('email'))
                @slot('placeholder', __('placeholder.email.default'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'subject', 'bag' => 'contact'])
                {{ __('Subject') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'subject')
                @slot('bag', 'contact')
                @slot('value', old('subject'))
                @slot('placeholder', __('placeholder.subject.default'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            @component('components.inputs.switch')
                @slot('name', 'terms')
                @slot('label')
                    {!! __('content.i accept the') !!}
                @endslot
                @slot('bag', 'contact')
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
            {!! __('misc.recaptcha-branding', ['font_size' => '10px']) !!}
        </div>

        @if ($errors->contact->has('g-recaptcha-response'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->contact->first('g-recaptcha-response') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group row flex-row">
        <div class="col-6 col-md-4">
            @component('components.inputs.cta-button', ['variant' => 'primary'])
                @slot('variant', 'primary')
                @slot('content', __('Submit'))
            @endcomponent
        </div>
        <div class="col-6 col-md-4">
            @component('components.inputs.cta-reset', ['variant' => 'primary'])
                @slot('content', __('Cancel'))
            @endcomponent
        </div>
    </div>
</form>
