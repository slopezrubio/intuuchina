<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="flexbox flexbox-wrap flexbox-jc-center">
                        @foreach($URLs as $actionURL)
                            <button class="cta">
                                <a href="{{ $actionURL }}" target="_blank">{{ $actionText[$loop->index] }}</a>
                            </button>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="cta__notice">
                        <p>{{ trans_choice('mails.generics.if you have trouble', count($URLs)) }}</p>
                        @foreach($URLs as $actionURL)
                            <p>
                                {{ $actionText[$loop->index] }}&nbsp;—&nbsp;
                                <a href="{{ $actionURL }}">{{ $actionURL }}</a>
                            </p>
                        @endforeach
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>