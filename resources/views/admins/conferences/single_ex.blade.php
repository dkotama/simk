@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $conf->name }}
                  <a href="#" class="btn btn-xs btn-primary">Edit Conference</a>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-2">
                        <b>Name</b>
                    </div>
                    <div class="col-md-8">
                      {{ $conf->name }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                        <b>URL</b>
                    </div>
                    <div class="col-md-8">
                      <a href="/{{$conf->url}}">{{ $conf->url}}</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                        <b>Description</b>
                    </div>
                    <div class="col-md-8">
                      {{ $conf->description }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                        <b>Start Date</b>
                    </div>
                    <div class="col-md-8">
                      09-Sep-2017 - 13-Sep-2017
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-12 text-center">
                        <b>Important Deadlines</b>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-md-3">
                        <b>Submission Deadline</b>
                    </div>
                    <div class="col-md-7">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Acceptance</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                        <del>09-Aug-2017</del>
                        <br><del>18-Aug-2017</del>
                        <br><b>28-Aug-2017</b>
                      <p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Camera Ready</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                        <del>09-Aug-2017</del>
                        <br><del>18-Aug-2017</del>
                        <br><b>28-Aug-2017</b>
                      <p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Registration</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                        <del>09-Aug-2017</del>
                        <br><del>18-Aug-2017</del>
                        <br><b>28-Aug-2017</b>
                      <p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 text-center">
                      <a href="#" class="btn btn-primary">Extends Deadlines</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
