<form action="{{ route('admin.new-offer') }}" id="create-offer" method="POST" enctype="multipart/form-data" class="extended-form">
    @csrf

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'title'])
                {{ __('Title') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'title')
                @slot('placeholder', __('placeholder.offer.title'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'location'])
                {{ __('Location') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' => __('content.job-locations')])
                @slot('name', 'location')
                @if(old('location') !== null)
                    @slot('value', old('location'))
                @endif
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'location'])
                {{ __('Industry') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' => __('content.industries')])
                @slot('name', 'industry')
                @if(old('industry') !== null)
                    @slot('value', old('industry'))
                @endif
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'duration'])
                {{ __('Duration') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.prepended-text')
                @slot('name', 'duration')
                @if(old('duration') !== null)
                    @slot('value', old('duration'))
                @endif
                {{ __('Month / s') }}
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'duration'])
                {{ __('Description') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.wysiwyg')
                @slot('name', 'description')
                @slot('placeholder', __('placeholder.offer.description'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'picture'])
                {{ __('Picture') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.file')
                @slot('name', 'picture')
                @slot('preview', '')
                @slot('muted', __('auth.allowed thumbnail formats'))
            @endcomponent
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4">
            @component('components.inputs.shutter-button')
                @slot('type', 'submit')
                @slot('content', __('Create') )
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