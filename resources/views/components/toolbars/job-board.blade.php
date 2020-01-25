<div class="toolbar">
    <div class="tool-group">
        <div class="tool tool__filter arrow-down icon">
            <label for="inputFilter">{{ __('content.filter by:') }}</label>
            <div class="select-wrapper col-md-10 col-md-10 col-form-label">
                <select class="custom-select" id="inputFilter" name="filterBy[]">
                    <option value="all" selected aria-selected="true">{{ __('placeholders.filter.indefinite an', ['value' => 'Industry']) }}</option>
                    @foreach (__('content.industries') as $key => $industry)
                        <option value="{{ $key }}">{{ $industry }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>