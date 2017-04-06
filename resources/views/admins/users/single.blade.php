@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">
                <strong>Show Single User</strong>
                <a href="{{ route('admin.user.edit', ['userId' => $showUser->id ]) }}"><button type="button" class="btn btn-success btn-xs">Edit User Data</button></a>
                @if ($showUser->isAdmin())
                  <a href="{{ route('organizer.detachroles', [$conf->url, $showUser->id, 'admin'])}}" class="btn btn-danger btn-xs pull-right">Revoke Admin Access</a>
                @else
                  <a href="{{ route('organizer.attachroles', [$conf->url, $showUser->id, 'admin'])}}" class="btn btn-danger btn-xs pull-right">Set as Admin</a>
                @endif

              </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-2"><b>Full Name</b></div>
                    <div class="col-sm-10">: {{  $showUser->salutation. ' ' . $showUser->last_name . ' ' . $showUser->first_name}}</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"><b>Country</b></div>
                    <div class="col-sm-10">: {{ $userCountry }}</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"><b>Status</b></div>
                    <div class="col-sm-10">: {{ $showUser->status }}</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"><b>Email</b></div>
                    <div class="col-sm-10">: {{ $showUser->email }}</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"><b>Address</b></div>
                    <div class="col-sm-10">: {{ $showUser->address }}</div>
                  </div>

                  <hr>
                  <table class="table table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>Id</th>
                        <th>Conference Name</th>
                        <th>Enrolls</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($conferences as $conf)
                      <tr>
                        <td>{{ $conf->id }}</td>
                        <td>{{ $conf->name }}
                          @if (!$showUser->isAdmin())
                            @if ($showUser->isAuthoring($conf))
                              <a href="{{ route('organizer.detachroles', [$conf->url, $showUser->id, 'author']) }}"><span class="label label-warning">author</span></a>
                            @endif
                            @if ($showUser->isReviewing($conf))
                              <a href="{{ route('organizer.detachroles', [$conf->url, $showUser->id, 'reviewer']) }}"><span class="label label-success">reviewer</span></a>
                            @endif
                            @if ($showUser->isOrganizing($conf))
                              <a href="{{ route('organizer.detachroles', [$conf->url, $showUser->id, 'organizer']) }}"><span class="label label-info">organizer</span></a>
                            @endif
                          @endif
                        </td>
                        <td>
                          @if (!$showUser->isAdmin())
                            @if (!$showUser->isReviewing($conf))
                              <a href="{{ route('organizer.attachroles', [$conf->url, $showUser->id, 'reviewer'])}}" class="btn btn-success btn-xs">Set Reviewer</a>
                            @endif
                            @if (!$showUser->isOrganizing($conf))
                              <a href="{{ route('organizer.attachroles', [$conf->url, $showUser->id, 'organizer'])}}" class="btn btn-info btn-xs">Set Organizer</a>
                            @endif
                            @if (!$showUser->isAuthoring($conf))
                              <a href="{{ route('organizer.attachroles', [$conf->url, $showUser->id, 'author'])}}" class="btn btn-warning btn-xs">Set Author</a>
                            @endif
                          @else
                            <p>This user is administrator of system.</p>
                          @endif
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
