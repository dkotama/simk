@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create New User</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('organizer.registerUser', ['confUrl' => $conf->url]) }}">

                        @include('forms.register')

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Set As</label>

                            <div class="col-md-6">
                              <label class="checkbox-inline"><input name="autoassign[]" type="checkbox" value="author" {{ (old('autoassign') !== null && in_array('author', old('autoassign'))) ? 'checked' : null }}>Author</label>
                              <label class="checkbox-inline"><input name="autoassign[]" type="checkbox" value="reviewer" {{ (old('autoassign') !== null && in_array('reviewer', old('autoassign'))) ? 'checked' : null }}>Reviewer</label>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top:20px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                                <a href="{{ route('organizer.manage', ['confUrl' => $conf->url]) }}"<button type="submit" class="btn btn-primary">
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
