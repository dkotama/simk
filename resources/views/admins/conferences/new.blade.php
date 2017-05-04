@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Conference</div>
                <div class="panel-body">
                  @include('forms.conference')
                </div>
            </div>
        </div>
    </div>
@endsection
