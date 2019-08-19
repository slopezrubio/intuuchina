<div class="filter_selector--mobile arrow-down icon col-8 col-md-8 col-lg-5">
    <label for="for="inputFilter"">{{ __('content.offers filter label') }}</label>
    <div class="custom-select-wrapper col-md-10 col-md-10 col-form-label">
        <select class="custom-select" id="inputFilter" name="filterBy[]">
            <option value="all" selected aria-selected="true">{{ __('content.offers filter placeholder') }}</option>
            @foreach (__('content.offers filter options') as $option)
                <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
            @endforeach
        </select>
    </div>
</div>