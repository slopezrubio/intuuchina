<form method="POST" class="form" action="{{ route('admin.offers') }}">
    @csrf
    <div class="container-fluid form_body--hidden">
        <div class="form-group row justify-content-center form-title">
            <h2 class="d-block text-center">Nueva oferta</h2>
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
            <div class="col-md-6">
                <input type="text" id="title" class="form-control" name="title" value="{{old('title')}}" required>
                @if ($errors->has('title'))
                    <div class="alert alert-danger" role="alert">
                       {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
            <div class="col-md-6">
                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>
                @if ($errors->has('location'))
                    <div class="alert alert-danger" role="alert">
                       {{ $errors->first('location') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="industry" class="col-md-4 col-form-label text-md-right">Industry</label>
            <div class="col-md-6">
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
                @if ($errors->has('industry'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('industry') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="duration" class="col-md-4 col-form-label text-md-right">Duration</label>
            <div class="col-md-6">
                <input type="text" id="duration" class="form-control" name="duration" value="{{old('duration')}}">
                @if ($errors->has('duration'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
            <div class="col-md-6">
                <textarea id="description" class="form-control"  name="description" rows="5" value="{{old('description')}}"></textarea>
                @if ($errors->has('description'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="preferred-skills" class="col-md-4 col-form-label text-md-right">Preferred Skills</label>
            <div class="col-md-6">
                <textarea id="preferred-skills" class="form-control" name="preferred-skills" rows="5" value="{{old('preferred-skills')}}"></textarea>
                @if ($errors->has('preferred-skills'))
                    <div class="alert alert-danger" role="alert">
                       {{ $errors->first('preferred-skills') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </div>
</form>