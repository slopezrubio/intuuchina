@if ($items->count() > 0)
    <table class="flex-table">
            <thead>
                    @foreach(array_keys((array) $items->first()) as $header)
                        @if ($header !== 'id')
                            <th scope="col">{{ str_replace('_', ' ', Str::title($header)) }}</th>
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
                    </tr>

                    @if (isset($action))
                        <tr class="flex-table__item-action">
                            <td colspan="{{ round(count(array_keys((array) $item))) - 1 }}">
                                @include($action)
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

    </table>
@endif