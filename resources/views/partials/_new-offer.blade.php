<form method="POST" action="{{ route('offers') }}">
    @csrf
    <div class="form-group row">
        <a href="" class="btn btn-primary">Añadir</a>
    </div>
    <div class="form-group row justify-content-center">
        <h2 class="text-primary d-block text-center">Nueva oferta</h2>
    </div>
    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
        <div class="col-md-6">
            <input type="text" id="title" class="form-control" name="title" required>
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
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
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
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
            @if ($errors->has('job-type'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('job-type') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="education" class="col-md-4 col-form-label text-md-right">Education</label>
        <div class="col-md-6">
            <input type="text" id="education" class="form-control" name="education">
            @if ($errors->has('education'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('education') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="duration" class="col-md-4 col-form-label text-md-right">Duration</label>
        <div class="col-md-6">
            <input type="text" id="duration" class="form-control" name="duration">
            @if ($errors->has('duration'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
        <div class="col-md-6">
            <textarea id="description" class="form-control" name="description" rows="5"></textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="preferred-skills" class="col-md-4 col-form-label text-md-right">Preferred Skills</label>
        <div class="col-md-6">
            <textarea id="preferred-skills" class="form-control" name="preferred-skills" rows="5"></textarea>
            @if ($errors->has('preferred-skills'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('preferred-skills') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="non-technical-skills" class="col-md-4 col-form-label text-md-right">Non-Technical Skills</label>
        <div class="col-md-6">
            <textarea id="non-technical-skills" class="form-control" name="non-technical-skills" rows="5"></textarea>
            @if ($errors->has('Non-Technical Skills'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('Non-Technical Skills') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary" value="Submit">
                @if ($errors->has('preferred-skills'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('preferred-skills') }}</strong>
                    </span>
                @endif
        </div>
    </div>
</form>