@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Conference</div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="">
                    {!! csrf_field() !!}
                    @include('forms.conference.name_url_desc')
                    @include('forms.conference.dates')
                    <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-btn fa-user"></i>Create Conference
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
