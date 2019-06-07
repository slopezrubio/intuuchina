<main>
    <section class="readable_section">
        <h3 class="readable_section_title">DESCRIPTION</h3>
        <p>{{ $offer->description }}</p>
    </section>
    <section class="readable_section">
        <h3 class="readable_section_title">DETAILS</h3>
        <div class="card_background-image">
            <div class="card_background-image_info">
                <p class="card-title">{{ ucfirst($offer->location) }}</p>
                <p class="card-text">{{ $offer->duration }}</p>
            </div>
        </div>
    </section>
    <section class="sendable_section--fixed">
        <div class="offers_buttons">
            <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="register">Inscribirse</a></button>
        </div>
    </section>
</main>