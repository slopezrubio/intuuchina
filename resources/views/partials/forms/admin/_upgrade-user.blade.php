<form id="upgrade-user" method="POST" enctype="multipart/form-data" class="extended-form" action="{{ route('admin.upgrade-user', ['user' => $user->id]) }}">
    @csrf

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'status'])
                {{ __('To Status') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' => App\Status::getSelectorOptions()])
                @slot('name', 'status')
                @slot('value', old('status'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'status'])
                {{ __('Email Attached') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.wysiwyg')
                @slot('name', 'message')
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'attachments'])
                {{ __('Attachments') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.file')
                @slot('name', 'attachments')
                @slot('muted', __('validation.custom.file.muted'))
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