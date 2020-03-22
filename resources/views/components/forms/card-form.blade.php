<form class="card-form" action="{{ $action }}" method="POST">
    @csrf
    @if(isset($hidden))
        @foreach($hidden as $name => $value)
            @component('components.inputs.hidden', [
                'name' => $name,
                'value' => $value
            ])
            @endcomponent
        @endforeach
    @endif

    @if(isset($buttons))
        @foreach($buttons as $button)
            @component('components.inputs.cta-button', [
                'content' => $button['content'],
                'name' => 'product',
                'variant' => 'primary',
            ])
                @if(isset($button['href']))
                    @slot('href', $button['href'])
                @endif

                @if(isset($button['value']))
                    @slot('value', $button['value'])
                @endif
            @endcomponent
        @endforeach
    @endif
</form>
