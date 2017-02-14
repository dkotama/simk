@extends('admins.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>All Users Registered In System</strong>

              <a href="#">
                <button type="button" class="btn btn-success btn-xs">Add User</button>
              </a>
            </div>
            <div class="panel-body">
                <div class="col-md-9 col-md-offset-3">
                    <div class="form-group">
                      <div class="col-md-8">
                        <select class="form-control" name="conference_url" id="conferenceUrl">
                            <option value="">Select Conference</option>
                          @foreach ($confs as $conf)
                            <option value="{{ $conf->url }}">{{ $conf->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-md-3">
                        <a id="refreshBtn"  target="_blank" type="submit" class="btn btn-default">See Users</a>
                      </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-top: 15px">
                  @include('users.table.all')
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('scripts.footer')
  <script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var organizePath = '/org/users';

    $("#conferenceUrl").change(function() {
      $("#refreshBtn").attr('href', baseUrl + '/' + $('#conferenceUrl option:selected').val() + organizePath);
    });
  </script>
@endsection
