@if ($items->count() > 0)
    <table class="flex-table" {{ isset($id) ? 'id=' . $id : '' }}>
            <thead>
                    @foreach(array_keys((array) $items->first()) as $header)
                        @if ($header !== 'id')
                            <th data-value="{{ $header }}" scope="col">{{ str_replace('_', ' ', Str::title($header)) }}</th>
                        @endif
                    @endforeach
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="flex-table__item-content">
                        @foreach(array_keys((array) $item) as $header)
                            @if ($header !== 'id')
                                <td data-label="{{ str_replace('_', ' ', Str::title($header)) }}">
                                    @if(empty($item->$header))
                                        {{ __('Not Provided') }}
                                    @endif

                                    {{ $item->$header }}
                                </td>
                            @endif
                        @endforeach

                        @if (isset($action))
                            <td class="flex-table__item-action">
                                @include($action)
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

    </table>

    @if (isset($pagination))
        {!! $pagination !!}
    @endif
@else
    <div class="flex-table">
        <p class="alert-message alert-message--empty-list">
            <i class="fas fa-wind"></i>
            <span>{{ __('content.no such item has been found', ['item' => $id]) }}</span>
        </p>
    </div>
@endif