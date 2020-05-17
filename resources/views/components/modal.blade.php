@if(isset($bag) )
    <div class="modal fade{{ isset($errors->$bag) && count($errors->$bag) > 0 ? ' show' : '' }}" tabindex="-1" id="{{ $name }}Modal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
@else
    <div class="modal fade{{ isset($errors->$name) && count($errors->name) > 0 ? ' show' : '' }}" tabindex="-1" id="{{ $name }}Modal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
@endif
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="{{ $name }}ModalTitle">{{ $title }}</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if(isset($body))
                <div class="modal-body">
                    {{ $body }}
                </div>
            @endif

            @if(isset($footer))
                <div class="modal-footer modal-column">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>