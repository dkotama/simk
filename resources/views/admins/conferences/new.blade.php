@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Conference</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.conf.post') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">URL</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="url" value="{{ old('url') }}">

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('start_conference') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Conference Start</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="start_conference">

                                @if ($errors->has('start_conference'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_conference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('conference_end') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Conference End</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="conference_end">

                                @if ($errors->has('conference_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('conference_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Deadline Dates</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('submission_deadline') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Submission</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="submission_deadline">

                                @if ($errors->has('submission_deadline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('submission_deadline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('acceptance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Acceptance</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="acceptance">

                                @if ($errors->has('acceptance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('acceptance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('camera_ready') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Camera Ready</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="camera_ready">

                                @if ($errors->has('camera_ready'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('camera_ready') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registration') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Registration</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="registration">

                                @if ($errors->has('registration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                                <a href="{{ route('admin.conf.all') }}"<button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Back
                                </button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
