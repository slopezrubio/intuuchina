<section class="course-information" id="bg-classroom-course">
    <div class="course-information_box price-box">
        @if(isset($params->course))
            @if($params->course != 1)
                <p><span>Precio por hora</span><span class="price-tag">{{ $params->price  }}<i class="euro">€</i>/&nbsp;h</span></p>
            @else
                <p><span>Desde</span><span class="price-tag">{{ $params->price }}<i class="euro">€</i></span></p>
            @endif
            <p><span class="advice">( {{ $params->extra_info }} )</span></p>
        @else
            <p><span>Desde</span><span class="price-tag">499<i class="euro">€</i></span></p>
            <p><span class="advice">( Estancia mínima de un mes )</span></p>
        @endif
    </div>
    <div class="course-information_box"></div>
</section>