@extends('layout')

@section('content')
  <div class="container container-content">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">All Conference</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-9">
          @foreach($confs as $conf)
            @if($conf->isCanUpload())
              <div class="list-group">
                <a href="/{{$conf->url }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{ $conf->name }} <span class="label label-success pull-right">Call For Paper</span> <span class="label label-success pull-right">Call For Participant</span></h4>
                  <p class="list-group-item-text">{{ $conf->description }}</p>
                </a>
              </div>
            @else
              <div class="list-group">
                <a href="/{{$conf->url }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{ $conf->name }} <span class="label label-danger pull-right">Submission Deadline Passed</span> <span class="label label-success pull-right">Call For Participant</span></h4>
                  <p class="list-group-item-text">{{ $conf->description }}</p>
                </a>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
