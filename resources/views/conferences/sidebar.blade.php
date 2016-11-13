            @if ($isAdmin || $isOrganizer)
            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Organizer Menu</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('enrolls', $conf->url) }}"><i class="glyphicon glyphicon-list"></i> Manage Users</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Menu B</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-link"></i> Menu C</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Menu D</a></li>
            </ul>

            <hr>            
            @endif
