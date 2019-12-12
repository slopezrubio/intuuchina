<div class="filter_selector--mobile arrow-down icon col-8 col-md-8 col-lg-5">
    <label for=inputFilter">{{ __('content.filter by:') }}</label>
    <div class="custom-select-wrapper col-md-10 col-md-10 col-form-label">
        <select class="custom-select" id="inputFilter" name="filterBy[]">
            <option value="all" selected aria-selected="true">{{ __('placeholders.filter.indefinite an', ['value' => 'Industry']) }}</option>
            @foreach (__('content.industries') as $key => $industry)
                <option value="{{ $key }}">{{ $industry }}</option>
            @endforeach
        </select>
    </div>
</div>