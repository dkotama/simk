@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $conf->name }}
                  <a href="{{ route('organizer.manage.edit', $conf->url) }}" class="btn btn-xs btn-primary">Edit Conference</a>
                </div>
                <div class="panel-body">
                  @include('forms.conference.single')
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <a href="{{ route('organizer.manage.extends', $conf->url) }}" class="btn btn-primary">Extends Deadlines</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
