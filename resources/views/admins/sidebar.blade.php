            @if ($user->isAdmin())
            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Administrator Menu</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('admin.conf.all') }}"><i class="glyphicon glyphicon-list"></i> Conferences</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-user"></i> Users</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-wrench"></i> System Settings</a></li>
            </ul>

            <hr>

            @endif
