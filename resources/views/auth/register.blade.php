@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surnames" class="col-md-4 col-form-label text-md-right">{{ __('Surnames') }}</label>
                            <div class="col-md-6">
                                <input id="surnames" type="text" class="form-control{{ $errors->has('surnames') ? ' is-invalid' : '' }}" name="surnames" value="{{ old('surnames') }}" required>

                                @if ($errors->has('surnames'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surnames') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputNationality" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>
                            <div class="col-md-6">
                                <input id="nationality" type="text" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" value="{{ old('nationality') }}" required>

                                @if ($errors->has('nationality'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputProgram" class="col-md-4 col-form-label text-md-right">Program</label>
                            <div class="col-md-6">
                                <select class="custom-select" id="inputProgram" name="program">
                                    <option value="intership" selected aria-selected="true">Intership program</option>
                                    <option value="inter_relocat">Intership + Relocation Program</option>
                                    <option value="full">Full intership</option>
                                    <option value="study">Study Chinese</option>
                                    <option value="universty">University</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputIndustry" class="col-md-4 col-form-label text-md-right">Industry</label>
                            <div class="col-md-6">
                                <select class="custom-select" id="inputIndustry" name="industry">
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
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
