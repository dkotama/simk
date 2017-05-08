@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $conf->name }}
                  <a href="{{ route('admin.conf.edit', $conf->url) }}" class="btn btn-xs btn-primary">Edit Conference</a>
                </div>
                <div class="panel-body">
                  @include('forms.conference.single')
                </div>
            </div>
        </div>
    </div>
@endsection
