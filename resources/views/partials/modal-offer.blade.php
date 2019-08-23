<div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('content.delete job offer modal') }}</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="removeOffer" method="GET" action="{{ url('/admin/offers/delete/' . $offers[0]->id) }}">
                @csrf
                <div class="modal-body">
                    <p class="modal-body__text">
                        {{ __('content.are you sure you want to remove permanently job offer', ['jobOffer' => $offers[0]->title]) }}
                    </p>
                </div>
                <div class="modal-footer modal-column">
                    <button type="submit" class="modal-button modal-button_primary">{{ __('content.agree') }}</button>
                    <button type="button" class="modal-button modal-button_secondary" data-dismiss="modal">{{ __('content.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>