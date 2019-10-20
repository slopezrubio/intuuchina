{{--GDPR Modal--}}
<div class="modal fade" id="GDPRModal" tabindex="-1" role="dialog" aria-labelledby="GDPRModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable info-modal" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="GDPRModalTitle">{!! __('gdpr.title') !!}</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('gdpr.text') !!}
            </div>
        </div>
    </div>
</div>