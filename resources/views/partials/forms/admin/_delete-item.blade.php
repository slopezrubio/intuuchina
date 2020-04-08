@slot('body')
    <form id="delete-{{ Str::singular($name) }}" action="{{ route('admin.delete-' .  Str::singular($name), [Str::singular($name) => $collection->first()->id]) }}">
        @method('DELETE')
        @csrf
        <p>
          {{ isset($message) ? $message : __('messages.deletion.' . Str::singular($name)) }}
        </p>
        <div class="form-group row">
            <div class="col-12 col-sm-6">
                @component('components.inputs.cta-button')
                    @slot('variant', 'primary')
                    @slot('content', __('Sure'))
                @endcomponent
            </div>
            <div class="col-12 col-sm-6">
                @component('components.inputs.cta-button')
                    @slot('variant', 'primary')
                    @slot('content', __('No'))
                @endcomponent
            </div>
        </div>
        </form>
@endslot

@slot('footer')

@endslot