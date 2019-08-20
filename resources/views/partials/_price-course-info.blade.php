<section class="course-information" id="bg-classroom-course">
    <div class="course-information_box price-box">
        @if(isset($params->course))
            @if($params->course != 1)
                <p>
                    <span>{{ __('content.hourly price') }}</span>
                </p>
                <div class="prices">
                    <span class="price-tag">{{ __('content.courses')['online']['es']['value'] }}<i class="currency">{{ __('content.courses')['online']['es']['currency'] }}{{ __('content.per hour symbol') }}</i></span>
                    <span class="price-tag">{{ __('content.courses')['online']['en']['value'] }}<i class="currency">{{ __('content.courses')['online']['en']['currency'] }}{{ __('content.per hour symbol') }}</i></span>
                </div>
                <p>
                    <span class="advice"><b>{{ __('content.please note') }}</b></span>
                    <span class="advice">{{ __('content.online course notice') }}</span>
                </p>
            @else
                <p>
                    <span>{{ __('content.from') }}</span>
                </p>
                <div class="prices">
                    <span class="price-tag">{{ __('content.courses')['in-person']['es']['value'] }}<i class="currency">{{ __('content.courses')['in-person']['es']['currency'] }}</i></span>
                    <span class="price-tag">{{ __('content.courses')['in-person']['en']['value'] }}<i class="currency">{{ __('content.courses')['in-person']['en']['currency'] }}</i></span>
                </div>
                <p>
                    <span class="advice"><b>{{ __('content.please note') }}</b></span>
                    <span class="advice">{{ __('content.in-person course notice') }}</span>
                </p>
            @endif
        @else
            @if ($params->currentCourse == 1)
                <p>
                    <span>{{ __('content.from') }}</span>
                </p>
                <div class="prices">
                    <span class="price-tag">{{ __('content.courses')['in-person']['es']['value'] }}<i class="currency">{{ __('content.courses')['in-person']['es']['currency'] }}</i></span>
                    <span class="price-tag">{{ __('content.courses')['in-person']['en']['value'] }}<i class="currency">{{ __('content.courses')['in-person']['en']['currency'] }}</i></span>
                </div>
                <p>
                    <span class="advice"><b>{{ __('content.please note') }}</b></span>
                    <span class="advice">{{ __('content.in-person course notice') }}</span>
                </p>
            @else
                <p>
                    <span>{{ __('content.hourly price') }}</span><span class="price-tag">{{ __('content.courses')['online']['es']['value'] }}<i class="currency">{{ __('content.courses')['in-person']['es']['currency'] }}{{ __('content.per hour symbol') }}</i></span>
                    <span class="price-tag">{{ __('content.courses')['online']['en']['value'] }}<i class="currency">{{ __('content.courses')['online']['en']['currency'] }}{{ __('content.per hour symbol') }}</i></span>
                </p>
                <p>
                    <span class="advice"><b>{{ __('content.please note') }}</b></span>
                    <span class="advice">{{ __('content.online course notice') }}</span>
                </p>
            @endif
        @endif
    </div>
</section>