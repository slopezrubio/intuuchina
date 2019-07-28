<section class="course-information" id="bg-classroom-course">
    <div class="course-information_box price-box">
        @if(isset($params->course))
            @if($params->course != 1)
                <p>
                    <span>Precio por hora</span><span class="price-tag">{{ $params->price->eu  }}<i class="currency">€</i>/&nbsp;h</span>
                    <span class="price-tag">{{ $params->price->usd  }}<i class="currency">USD</i>/&nbsp;h</span>
                </p>
            @else
                <p>
                    <span>Desde</span><span class="price-tag">{{ $params->price->eu }}<i class="currency">€</i></span><span class="price-tag">{{ $params->price->usd }}<i class="currency">USD</i></span>
                </p>
            @endif
            <p>
                <span class="advice"><b>PLEASE NOTE</b></span>
                <span class="advice">{{ $params->extra_info }}</span>
            </p>
        @else
            @if ($params->currentCourse == 1)
                <p>
                    <span>Desde</span><span class="price-tag">499<i class="currency">€</i></span><span class="price-tag">470<i class="currency">USD</i></span>
                </p>
                <p>
                    <span class="advice"><b>PLEASE NOTE</b></span>
                    <span class="advice">The price above corresponds to the minimun staying of one month. Visa fees are not included.</span>
                </p>
            @else
                <p>
                    <span>Precio por hora</span><span class="price-tag">18<i class="currency">€</i>/&nbsp;h</span>
                    <span class="price-tag">15<i class="currency">USD</i>/&nbsp;h</span>
                </p>
                <p>
                    <span class="advice"><b>PLEASE NOTE</b></span>
                    <span class="advice">A minimum number of 40 hours in order to apply for this course.</span>
                </p>
            @endif
        @endif
    </div>
</section>