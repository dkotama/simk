@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create New User</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.register') }}">

                        @include('forms.register')

                        <div class="form-group" style="padding-top:20px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                                <!-- <a href=""<button type="submit" class="btn btn-primary"> -->
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
