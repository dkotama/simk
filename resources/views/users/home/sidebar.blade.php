            @if(!$user->isAdmin())
              <a href="/all" class="list-group-item list-group-item-success" style="text-align: center">Join New Conference</a>
            @endif

            @if(count($authoring) > 0)
              <hr>
                <strong><i class="glyphicon glyphicon-th-large"></i> Subscribed Conference</strong>
              <hr>

              <ul class="nav nav-pills nav-stacked">
                @foreach($authoring as $auth)
                  <li><a href="{{ route('user.home.manage', $auth->url)}}"><i class="glyphicon glyphicon-briefcase"></i> {{ strtoupper($auth->url) }}</a></li>
                @endforeach
              </ul>

            @endif

            @if(count($reviewing) > 0)
              <hr>
                <strong><i class="glyphicon glyphicon-th-large"></i> Reviewed Conference</strong>
              <hr>

              <ul class="nav nav-pills nav-stacked">
                @foreach($reviewing as $revw)
                  <li><a href="{{ route('reviewer.manage', $revw->url)}}"><i class="glyphicon glyphicon-briefcase"></i> {{ strtoupper($revw->url) }}</a></li>
                @endforeach

              </ul>
            @endif

            @if(count($organizing) > 0)
              <hr>
                <strong><i class="glyphicon glyphicon-th-large"></i> Organized Conference</strong>
              <hr>

              <ul class="nav nav-pills nav-stacked">
                @foreach($organizing as $org)
                  <li><a href="{{ route('organizer.manage', $org->url)}}"><i class="glyphicon glyphicon-briefcase"></i> {{ strtoupper($org->url) }}</a></li>
                @endforeach

              </ul>
            @endif
            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Preferences</strong></a>

            <hr>


            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('user.profile', ['userId' => $user->id]) }}"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
            </ul>
            <hr>
