<form method="POST" class="form" enctype="multipart/form-data" action="{{ route('admin.offers') }}">
    @csrf
    <div class="container {{ count($errors) > 0 ? 'items_form' : 'items_form--hidden'}}">
        <div class="form-group row justify-content-center form-title">
            <h2 class="d-block text-center">{{ __('content.new offer') }}</h2>
        </div>
        <div class="row form_body justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-left">{{ __('content.offer title label') }}</label>
                    <div class="col-md-9">
                        <input type="text" id="title" class="form-control" name="title" value="{{old('title')}}" placeholder="{{ __('content.job position') }}" required>
                        @if ($errors->has('title'))
                            <div class="alert alert-danger" role="alert">
                               {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row" id="locationOfferFieldset">
                    <label for="location" class="col-md-3 col-form-label text-md-left">{{ __('content.offer location label') }}</label>
                    <div class="col-md-9">
                        <div class="regular-select-wrapper">
                            <select class="form-control" name="location" id="location">
                                @for ($i = 0; $i < count(__('content.offers locations')); $i++)
                                    @if ($i === 0)
                                        <option value="{{ __('content.offers locations')[$i]['value'] }}" selected aria-selected="true">{{ __('content.offers locations')[$i]['text'] }}</option>
                                    @else
                                        <option value="{{ __('content.offers locations')[$i]['value'] }}">{{ __('content.offers locations')[$i]['text'] }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        @if ($errors->has('location'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row" id="industryOfferFieldset">
                    <label for="industry" class="col-md-3 col-form-label text-md-left">Industry</label>
                    <div class="col-md-9">
                        <div class="regular-select-wrapper">
                            <select class="form-control" name="industry" id="industry">
                                @for ($i = 0; $i < count(__('content.offers filter options')); $i++)
                                    @if ($i === 0)
                                        <option value="{{ __('content.offers filter options')[$i]['value'] }}" selected aria-selected="true">{{ __('content.offers filter options')[$i]['text'] }}</option>
                                    @else
                                        <option value="{{ __('content.offers filter options')[$i]['value'] }}">{{ __('content.offers filter options')[$i]['text'] }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        @if ($errors->has('industry'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('industry') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="duration" class="col-md-3 col-form-label text-md-left">Duration</label>
                    <div class="col-md-9">
                        <input type="text" id="duration" class="form-control" name="duration" value="{{old('duration')}}" placeholder="{{ __('content.amount of months') }}">
                        @if ($errors->has('duration'))
                                <div class="alert alert-danger" role="alert">
                                {{ $errors->first('duration') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-left">{{ __('description') }}</label>
                    <input type="hidden" name="description">
                    <div class="col-md-9">
                        <div class="editor">
                        </div>
                        @if ($errors->has('description'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="picture" class="col-md-3 col-form-label text-md-left">Picture</label>
                    <div class="col-md-9">
                        <input type="file" id="duration" class="form-control" name="picture"">
                        @if ($errors->has('picture'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('picture') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="row justify-content-center col-12 my-4">
                        <button type="submit" class="shutter-button col-4">Submit</button>
                        <button type="reset" class="shutter-button col-4 offset-2 dropdown-button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>