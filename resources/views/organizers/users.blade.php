@extends('organizers.dashboard')

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <strong>Registered User on {{ $conf->name }}</strong>
              <a href="{{ route('organizer.addUser', ['confUrl' => $conf->url]) }}">
                <button type="button" class="btn btn-success btn-xs">Add User</button>
              </a>
            </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Enrolls</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($users as $usr)
                <tr>
                  <td>{{ $i }}</td>
                  <td>
                    {{ $usr->title . " " . $usr->last_name . " " . $usr->first_name }}
                    @if ($usr->isAdmin())
                      @if ($user->isAdmin())
                        <a href="{{ route('organizer.detachroles', [$conf->url, $usr->id, 'admin']) }}"><span class="label label-danger">Administrator</span></a>
                      @else
                        <span class="label label-danger">Administrator</span>
                      @endif
                    @else
                      @if ($usr->isAuthoring($conf))
                        <a href="{{ route('organizer.detachroles', [$conf->url, $usr->id, 'author']) }}"><span class="label label-warning">author</span></a>
                      @endif
                      @if ($usr->isReviewing($conf))
                        <a href="{{ route('organizer.detachroles', [$conf->url, $usr->id, 'reviewer']) }}"><span class="label label-success">reviewer</span></a>
                      @endif
                      @if ($usr->isOrganizing($conf))
                        @if($user->id === $usr->id)
                          <span class="label label-info">organizer</span>
                        @else
                          <a href="{{ route('organizer.detachroles', [$conf->url, $usr->id, 'organizer']) }}"><span class="label label-info">organizer</span></a>
                        @endif
                      @endif
                    @endif
                  </td>
                  <td>
                    @if(!$usr->isAdmin())
                      @if (!$usr->isReviewing($conf))
                        <a href="{{ route('organizer.attachroles', [$conf->url, $usr->id, 'reviewer'])}}" class="btn btn-success btn-xs">Set Reviewer</a>
                      @endif
                      @if (!$usr->isOrganizing($conf))
                        <a href="{{ route('organizer.attachroles', [$conf->url, $usr->id, 'organizer'])}}" class="btn btn-info btn-xs">Set Organizer</a>
                      @endif
                      @if (!$usr->isAuthoring($conf))
                        <a href="{{ route('organizer.attachroles', [$conf->url, $usr->id, 'author'])}}" class="btn btn-warning btn-xs">Set Author</a>
                      @endif
                      @if ($user->isAdmin())
                        <a href="{{ route('organizer.attachroles', [$conf->url, $usr->id, 'admin'])}}" class="btn btn-danger btn-xs">Set Admin</a>
                      @endif
                    @endif
                  </td>
                  <td>
                    @if (!$usr->isAdmin())
                     <a href="{{ route('organizer.editUser', ['confUrl' => $conf->url, 'userId' => $usr->id])}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                     <a href="" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                    @endif
                  </td>
                </tr>
                </tr>
                <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Participant Section -->
    @if($userSelected === 'registered')
    <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <strong>Users Applying For Participant</strong>
            </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($participants as $partiAppl)
              <?php $usr = $partiAppl->user ?>
                <tr>
                  <td>{{ $i }}</td>
                  <td>
                    <a href="{{ route('organizer.singleParticipant', ['confUrl' => $conf->url, 'userId' => $usr->id]) }}">
                      {{ $usr->title . " " . $usr->last_name . " " . $usr->first_name }}
                    </a>
                  </td>
                  <td>
                    {{ $usr->getPaymentStatus($conf->id) }}
                  </td>
                </tr>
                </tr>
                <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
  </div>
@endsection
