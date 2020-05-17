@slot('body')
    <form id="delete-{{ Str::singular($key) }}" action="{{ route('admin.delete-' .  Str::singular($key), [Str::singular($key) => $collection->first()->id]) }}">
        @method('DELETE')
        @csrf
        <p>
          {{ isset($message) ? $message : __('messages.deletion.' . Str::singular($key)) }}
        </p>
        <div class="form-group row">
            <div class="col-12 col-sm-6">
                @component('components.inputs.cta-button')
                    @slot('variant', 'primary')
                    @slot('content', __('Sure'))
                @endcomponent
            </div>
            <div class="col-12 col-sm-6">
                @component('components.inputs.cta-close')
                    @slot('variant', 'primary')
                    @slot('content', __('No'))
                @endcomponent
            </div>
        </div>
        </form>
@endslot

@slot('footer')

@endslot