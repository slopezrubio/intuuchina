<section id="course-info">
    <div class="info-box">
        @if (isset($course))
            <div class="info-box__header">
                <p>
                    @switch($course)
                        @case('in-person')
                            <span style="text-transform: uppercase">{{ __('content.from') }}</span>
                            @break
                        @case('online')
                            <span style="text-transform: uppercase">{{ __('content.hourly price') }}</span>
                            @break
                    @endswitch
                </p>
            </div>
            <div class="info-box__body">
                <div class="info-box__price-table">
                    @foreach(__('content.courses.'. $course . '.price') as $currency => $value)
                        @switch($course)
                            @case('in-person')
                            <span class="info-box__price-table--tag">{{ $value }}<i class="info-box__price-table--symbol">{{ __('currencies.' . $currency . '.symbol') . ' / ' . __('currencies.' . $currency . '.code')}}</i></span>
                                @break
                            @case('online')
                            <span class="info-box__price-table--tag">{{ $value }}<i class="info-box__price-table--symbol">{{ __('currencies.' . $currency . '.symbol') . ' / h' }}</i></span>
                                @break
                        @endswitch
                    @endforeach
                </div>
            </div>
            <div class="info-box__footer">
                <h3>{{ __('content.please note') }}</h3>
                <p>
                    <span class="info-box__advice">{{ __('content.courses.' . $course . '.warning') }}</span>
                </p>
            </div>
        @else
            <div class="info-box__header">
                <p>
                    @switch(array_key_first(__('content.courses')))
                        @case('in-person')
                            <span style="text-transform: uppercase">{{ __('content.from') }}</span>
                            @break
                        @case('online')
                            <span style="text-transform: uppercase">{{ __('content.hourly price') }}</span>
                            @break
                    @endswitch
                </p>
            </div>
            <div class="info-box__body">
                <div class="info-box__price-table">
                    @foreach(__('content.courses.' . array_key_first(__('content.courses')) . '.price') as $currency => $value)
                        @switch(array_key_first(__('content.courses')))
                            @case('in-person')
                                <span class="info-box__price-table--tag">{{ $value }}<i class="info-box__price-table--symbol">{{ __('currencies.' . $currency . '.symbol') . ' / ' . __('currencies.' . $currency . '.code')}}</i></span>
                                @break
                            @case('online')
                                <span class="info-box__price-table--tag">{{ $value }}<i class="info-box__price-table--symbol">{{ __('currencies.' . $currency . '.symbol') . ' / h' }}</i></span>
                                @break
                        @endswitch
                    @endforeach
                </div>
            </div>
            <div class="info-box__footer">
                <h3>{{ __('content.please note') }}</h3>
                <p>
                    <span class="info-box__advice">{{ __('content.courses.' . array_key_first(__('content.courses')) . '.warning') }}</span>
                </p>
            </div>
        @endif
    </div>
</section>