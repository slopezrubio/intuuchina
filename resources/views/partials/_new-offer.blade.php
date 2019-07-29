<form method="POST" class="form" action="{{ route('admin.offers') }}">
    @csrf
    <div class="container items_form--hidden">
        <div class="form-group row justify-content-center form-title">
            <h2 class="d-block text-center">Nueva oferta</h2>
        </div>
        <div class="row form_body justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-left">Title</label>
                    <div class="col-md-9">
                        <input type="text" id="title" class="form-control" name="title" value="{{old('title')}}" required>
                        @if ($errors->has('title'))
                            <div class="alert alert-danger" role="alert">
                               {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row" id="locationOfferFieldset">
                    <label for="location" class="col-md-3 col-form-label text-md-left">location</label>
                    <div class="col-md-9">
                        <div class="regular-select-wrapper">
                            <select class="form-control" name="location" id="location">
                                <option value="honk-kong" selected aria-selected="true">Honk Kong</option>
                                <option value="beijing">Beijing</option>
                                <option value="shanghai">Shanghai</option>
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
                                <option value="finance" selected aria-selected="true">Finance</option>
                                <option value="design">Design</option>
                                <option value="engineering">Engineering</option>
                                <option value="consultant">Consultant</option>
                                <option value="education">Education</option>
                                <option value="hostelry">Hostelry</option>
                                <option value="it">IT</option>
                                <option value="legal">Legal</option>
                                <option value="logistic">Logistic</option>
                                <option value="marketing_business">Marketing & Business Development</option>
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
                        <input type="text" id="duration" class="form-control" name="duration" value="{{old('duration')}}">
                        @if ($errors->has('duration'))
                                <div class="alert alert-danger" role="alert">
                                {{ $errors->first('duration') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-left">Description</label>
                    <div class="col-md-9">
                        <textarea id="description" class="form-control"  name="description" rows="5" value="{{old('description')}}"></textarea>
                        @if ($errors->has('description'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="preferred-skills" class="col-md-3 col-form-label text-md-left">Preferred Skills</label>
                    <div class="col-md-9">
                        <textarea id="preferred-skills" class="form-control" name="preferred-skills" rows="5" value="{{old('preferred-skills')}}"></textarea>
                        @if ($errors->has('preferred-skills'))
                            <div class="alert alert-danger" role="alert">
                               {{ $errors->first('preferred-skills') }}
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