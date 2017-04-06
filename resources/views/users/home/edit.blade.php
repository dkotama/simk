@extends('users.home.index')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.profile.update', ['userId' => $user->id])}}">

                        @include('forms.register')

                        <div class="form-group" style="padding-top:20px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i>Update Profile
                                  </button>
                                <a href="{{ route('user.profile', ['userId' => $user->id]) }}"<button type="submit" class="btn btn-primary">
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
