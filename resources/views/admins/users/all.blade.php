@extends('admins.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Users Management</strong>
              <a href="#">
                <button type="button" class="btn btn-success btn-xs">Add User</button>
              </a>
            </div>
            <div class="panel-body">
                <div class="col-md-8 col-md-offset-3">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="select-conference">Select Conference</label>
                      <select class="form-control">
                        <option>International Fucking Conference One</option>
                        <option>International Fucking Conference Two</option>
                        <option>International Fucking Conference Three</option>
                        <option>International Fucking Conference Four</option>
                        <option>International Fucking Conference Five</option>
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
