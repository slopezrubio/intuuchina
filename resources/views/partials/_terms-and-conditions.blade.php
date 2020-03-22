@slot('name', 'termsAndConditions')
@slot('title', __('Terms & Conditions'))

@slot('body')
    {!! __('terms_and_conditions.introduction') !!}

    <ol class="number_list">
        @foreach (__('terms_and_conditions.terms') as $term)
            <li>
                @foreach ($term as $key => $element)
                    @if (is_array($element) === false)
                        {!! $element !!}
                    @else
                        @isset ($element['title'])
                            <p class="paragraph_title">{{ $element['title'] }}</p>
                        @endisset
                        <ol class="{{ $element['class'] }}">
                            @foreach ($element as $key => $listItem)
                                @if (is_integer($key))
                                    <li>{!! $listItem !!}</li>
                                @endif
                            @endforeach
                        </ol>
                    @endif
                @endforeach
            </li>
        @endforeach
    </ol>
@endslot