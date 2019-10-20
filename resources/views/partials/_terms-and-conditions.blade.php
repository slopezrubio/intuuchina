 {{-- Terms and Conditions Modal --}}
<div class="modal fade" id="termsAndConditionsModal" tabindex="-1" role="dialog" aria-labelledby="termsAndConditionsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable info-modal" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="termsAndConditionsModalTitle">Terms & Conditions</h5>
                <button type="button" class="close medium-icon" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               {!! __('terms_and_conditions.introduction') !!}

                <ol class="number_list">

                   @foreach (__('terms_and_conditions.terms') as $term)
                       <li>
                           @foreach ($term as $key => $element)
                               @if (is_array($element) === false)
                                   {!! $element !!}
                               @else
                                   @isset ($element['title'])
                                       <p class="paragraph_title">{{ $element['title'] }}</p>
                                   @endisset
                                   <ol class="{{ $element['class'] }}">
                                       @foreach ($element as $key => $listItem)
                                           @if (is_integer($key))
                                            <li>{!! $listItem !!}</li>
                                           @endif
                                       @endforeach
                                   </ol>
                               @endif
                           @endforeach
                       </li>
                   @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>