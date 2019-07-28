<section class="course-descriptions">
    <div class="description-container">
        <div class="description-base">
            <div class="description-header">
                <h2 id="presencial">Curso presencial <span>en China</span></h2>
                <a class="cta" href="{{ route('register') }}">Inscribirse</a>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore fugit doloribus praesentium nam quas,
                aliquid nulla beatae officiis velit. Nemo sint nihil consectetur dolor nam debitis repellat
                ipsa quia ullam consequatur sequi quidem, dolore recusandae odit maiores iste harum ipsam?
            </p>
        </div>
        <div class="description-base">
            <div class="description-header">
                <h2 id="online">Curso<span> Online</span></h2>
                <a class="cta" href="{{ route('register') }}">Inscribirse</a>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore fugit doloribus praesentium nam quas,
                aliquid nulla beatae officiis velit. Nemo sint nihil consectetur dolor nam debitis repellat
                ipsa quia ullam consequatur sequi quidem, dolore recusandae odit maiores iste harum ipsam?
            </p>
        </div>
    </div>
    <div class="description-options">
        @if ($params->currentCourse == 1)
            <a class="selected" href="#"><span>Presencial</span></a>
        @else
            <a href="#"><span>Presencial</span></a>
        @endif

        @if ($params->currentCourse == 2)
            <a class="selected" href="#"><span>Online</span></a>
        @else
            <a href="#"><span>Online</span></a>
        @endif
    </div>
</section>
@include('partials._price-course-info')