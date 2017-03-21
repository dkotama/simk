            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Organizer Menu</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('organizer.allUser', $conf->url) }}"><i class="glyphicon glyphicon-user"></i> Manage Users</a></li>
                @if(isset($userSelected))
                  <ul class="nav nav-pills nav-stacked" style="padding-left:20px;">
                    <li class="{{ ($userSelected === 'registered') ? 'active' : NULL}}"><a href="{{ route('organizer.allUser', $conf->url) }}"><i class="glyphicon glyphicon-chevron-right"></i> Registered</a></li>
                    <li class="{{ ($userSelected === 'nonregistered') ? 'active' : NULL}}"><a href="{{ route('organizer.allUser', ['confUrl' => $conf->url, 'mode' => 'nonregistered']) }}"><i class="glyphicon glyphicon-chevron-right"></i> Non Registered</a></li>
                  </ul>
                @endif
              <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Menu B</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-link"></i> Menu C</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Menu D</a></li>
            </ul>

            <hr>
