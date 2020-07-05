<form id="edit-offer" method="POST" enctype="multipart/form-data" action="{{ route('admin.update-offer', ['offer' => $offer->id]) }}" class="extended-form">
    @csrf

    @if($errors->any())
        <div class="row">
            <div class="error-message col-12">
                <span>
                    <i class="fas fa-times"></i>
                    {{ __('validation.custom.forms.admin.edit-offer.invalid') }}
                </span>
            </div>
        </div>
    @endif

    @component('components.inputs.hidden')
        @slot('name', 'id')
        @slot('id', 'id')
        @slot('value', $offer->id)
    @endcomponent

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'title'])
                {{ __('Title') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.text')
                @slot('name', 'title')
                @slot('value', $offer->title)
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
                @slot('value', $offer->location)
            @endcomponent
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            @component('components.inputs.label', ['name' => 'industry'])
                {{ __('Industry') }}
            @endcomponent
        </div>
        <div class="col-md-9">
            @component('components.inputs.select', ['options' => App\Category::getSelectorOptions(App\Program::where('value', 'internship')->first()->industries)])
                @slot('name', 'industry')
                @slot('value', $offer->category->value)
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
                @slot('value', $offer->duration !== null ? $offer->duration : old('duration'))
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
                @slot('delta', $offer->description)
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
                @slot('preview', Storage::url('images/' . $offer->picture))
                @slot('muted', __('Job picture'))
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