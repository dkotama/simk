@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Conference</div>
                <div class="panel-body">

                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.conf.update', $conf->url) }}">
                    {!! csrf_field() !!}
                    @include('forms.conference.name_url_desc')

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-user"></i>Update
                            </button>
                            <a href="{{ route('admin.conf.show', $conf->url) }}"<button type="submit" class="btn btn-primary">
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
