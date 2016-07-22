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
                        <div class="form-group{{ $errors->has('start_submit') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Start Submit</label>
                          <div class="col-md-6">
                              <input type="date" class="form-control" name="start_submit" value="{{ old('start_submit') }}">

                              @if ($errors->has('start_submit'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('start_submit') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('end_submit') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">End Submit</label>
                          <div class="col-md-6">
                              <input type="date" class="form-control" name="end_submit" value="{{ old('end_submit') }}">

                              @if ($errors->has('end_submit'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('end_submit') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Start Date</label>
                          <div class="col-md-6">
                              <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">

                              @if ($errors->has('start_date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('start_date') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">End Date</label>
                          <div class="col-md-6">
                              <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">

                              @if ($errors->has('end_date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('end_date') }}</strong>
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
