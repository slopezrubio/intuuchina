<form method="POST" class="form" action="{{ route('offers') }}">
    @csrf
    <div class="form-group row form_header">
        <a href="#" class="dropdown-button">Crear Nueva</a>
    </div>
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
                <select class="form-control" name="location" id="location">
                    <option value="shangai">Shangai</option>
                    <option value="beijing">Beijing</option>
                </select>
                @if ($errors->has('location'))
                    <div class="alert alert-danger" role="alert">
                       {{ $errors->first('location') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="job-type" class="col-md-4 col-form-label text-md-right">Job Type</label>
            <div class="col-md-6">
                <select class="form-control" name="job-type" id="job-type">
                        <option value="Automotive">Automotive</option>
                        <option value="Busines-Devoelopment">Business Development</option>
                        <option value="Consultant">Consultant</option>
                        <option value="Desing">Desing</option>
                        <option value="Distribution">Destribution</option>
                        <option value="Education">Education</option>
                        <option value="Engineerring">Engineerring</option>
                        <option value="Finance">Finance</option>
                        <option value="Healt-Care">Healt Care</option>
                        <option value="Hospitlity">Hospitality</option>
                        <option value="Human-Resources">Human Resouces</option>
                        <option value="Information_Technology">Information Technology</option>
                        <option value="Legal">Legal</option>
                        <option value="Logistics">Logistics</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Nonpront">Nonpront</option>
                        <option value="Sales">Sales</option>
                        <option value="Transportation">Transportation</option>
                </select>
                @if ($errors->has('job-type'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('job-type') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="education" class="col-md-4 col-form-label text-md-right">Education</label>
            <div class="col-md-6">
                <select class="form-control" name="education" id="education">
                    <option value="graduate_degree">Graduate Degree</option>
                    <option value="bachelor_degree">Bachelor Degree</option>
                </select>
                @if ($errors->has('education'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('education') }}
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
            <label for="non-technical-skills" class="col-md-4 col-form-label text-md-right">Non-Technical Skills</label>
            <div class="col-md-6">
                <textarea id="non-technical-skills" class="form-control" name="non-technical-skills" rows="5" value="{{old('non-technical-skills')}}"></textarea>
                @if ($errors->has('non-technical-skills'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('non-technical-skills') }}
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