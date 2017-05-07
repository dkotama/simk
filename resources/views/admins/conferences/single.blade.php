@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $conf->name }}
                  <a href="{{ route('admin.conf.edit', $conf->url) }}" class="btn btn-xs btn-primary">Edit Conference</a>
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
                        <?php $lastIndex = count($dates['submission_deadline']) - 1 ?>
                        {{ $dates['start_conference'][$lastIndex]['date'] . ' - ' .  $dates['end_conference'][$lastIndex]['date']}}
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
                      <p>
                      <?php $count = 0 ?>
                      @foreach($dates['submission_deadline'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Acceptance</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                      <?php $count = 0 ?>
                      @foreach($dates['acceptance'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Camera Ready</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                      <?php $count = 0 ?>
                      @foreach($dates['camera_ready'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <b>Registration</b>
                    </div>
                    <div class="col-md-7">
                      <p>
                      <?php $count = 0 ?>
                      @foreach($dates['registration'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                      </p>
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
