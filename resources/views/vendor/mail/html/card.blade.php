<div class="notification-card">
    <div class="notification-card__header">
        <h2>{{ $header }}</h2>
    </div>
    <div class="notification-card__body">
        {!! $body !!}
        <table class="details">
            @foreach($fields as $fieldName => $field)
                <tr>
                    <th><p>{{ ucfirst($fieldName) }}</p></th>
                    <td><p>{{ $field }}</p></td>
                </tr>
            @endforeach
        </table>
    </div>
    @if (isset($actions))
        @foreach($actions as $action)
            <div class="notification-card__action">
                <button class="cta">
                    <a href="{{ $URLs[$loop->index] }}">{{ $action }}</a>
                </button>
            </div>
        @endforeach
    @endif
</div>