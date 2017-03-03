@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('organizer.updateUser', ['confUrl' => $conf->url]) }}">

                        @include('forms.register')

                        <div class="form-group" style="padding-top:20px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                                <a href="{{ route('organizer.allUser', ['confUrl' => $conf->url]) }}"<button type="submit" class="btn btn-primary">
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
