@extends('layout')

@section('content')
  <div class="container container-content">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">All Conference</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          @foreach($confs as $conf) 
          <div class="list-group">
            <a href="/{{$conf->url }}" class="list-group-item">
              <h4 class="list-group-item-heading">{{ $conf->name }}</h4>
              <p class="list-group-item-text">{{ $conf->description }}</p>
            </a>
          </div>      
          @endforeach
        </div> 
      </div>
    </div>
  </div>
@endsection
