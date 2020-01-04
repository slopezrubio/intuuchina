<section class="course-information" id="bg-classroom-course">
    <div class="course-information_box price-box">
        @if (isset($selected_course))
            <p>
                @switch($selected_course)
                    @case('in-person')
                        <span>{{ __('content.from') }}</span>
                        @break
                    @case('online')
                        <span>{{ __('content.hourly price') }}</span>
                        @break
                @endswitch
            </p>
            <div class="prices">
                @foreach(__('content.courses.'. $selected_course . '.price') as $currency => $value)
                    @switch($selected_course)
                        @case('in-person')
                        <span class="price-tag">{{ $value }}<i class="currency">{{ __('currencies.' . $currency . '.symbol') . ' / ' . __('currencies.' . $currency . '.code')}}</i></span>
                            @break
                        @case('online')
                        <span class="price-tag">{{ $value }}<i class="currency">{{ __('currencies.' . $currency . '.symbol') . ' / h' }}</i></span>
                            @break
                    @endswitch
                @endforeach
            </div>
            <p>
                <span class="advice"><b>{{ __('content.please note') }}</b></span>
                <span class="advice">{{ __('content.courses.' . $selected_course . '.warning') }}</span>
            </p>
        @else
            <p>
                @switch(array_key_first(__('content.courses')))
                    @case('in-person')
                        <span>{{ __('content.from') }}</span>
                        @break
                    @case('online')
                        <span>{{ __('content.hourly price') }}</span>
                        @break
                @endswitch
            </p>
            <div class="prices">
                @foreach(__('content.courses.' . array_key_first(__('content.courses')) . '.price') as $currency => $value)
                    @switch(array_key_first(__('content.courses')))
                        @case('in-person')
                            <span class="price-tag">{{ $value }}<i class="currency">{{ __('currencies.' . $currency . '.symbol') . ' / ' . __('currencies.' . $currency . '.code')}}</i></span>
                            @break
                        @case('online')
                            <span class="price-tag">{{ $value }}<i class="currency">{{ __('currencies.' . $currency . '.symbol') . ' / h' }}</i></span>
                            @break
                    @endswitch
                @endforeach
            </div>
            <p>
                <span class="advice"><b>{{ __('content.please note') }}</b></span>
                <span class="advice">{{ __('content.courses.' . array_key_first(__('content.courses')) . '.warning') }}</span>
            </p>
        @endif
    </div>
</section>