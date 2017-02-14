@extends('admins.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>All User Participated in {{ $conf->name }}</strong>
              <a href="#">
                <button type="button" class="btn btn-success btn-xs">Add User</button>
              </a>
            </div>
            <div class="panel-body">
                <div class="col-md-8 col-md-offset-3">
                  <form class="form-inline" action="{{ (route('admin.user.refresh')) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="select-conference">Select Conference</label>
                      <select class="form-control" name="url">
                        @foreach ($confs as $confor)
                          <option value="{{ $confor->url }}">{{ $confor->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-default">See Users</button>
                  </form>
                </div>
                <div class="col-md-12" style="padding-top: 15px">
                  @include('users.table.all')
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
