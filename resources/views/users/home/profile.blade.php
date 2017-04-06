@extends('users.home.index')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">
                <strong>My Profile</strong>
                <a href="{{ route('user.profile.edit', ['userId' => $user->id])}}"><button type="button" class="btn btn-success btn-xs">Edit Profile</button></a>

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
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($conferences as $conf)
                      <tr>
                        <td>{{ $conf->id }}</td>
                        <td>{{ $conf->name }}
                            @if ($showUser->isAuthoring($conf))
                              <span class="label label-warning">author</span>
                            @endif
                            @if ($showUser->isReviewing($conf))
                              <span class="label label-success">reviewer</span>
                            @endif
                            @if ($showUser->isOrganizing($conf))
                              <span class="label label-info">organizer</span>
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
