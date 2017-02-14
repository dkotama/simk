    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Project SIMK</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            @if (isset($signedIn) && !$signedIn)
            <li><a href="/register">Register</a></li>
            <li><a href="/login">Login</a></li>
            @elseif (isset($user) && $user->isAdmin())
              <li><a href="/admin/conferences">Admin Dashboard</a></li>
            @endif
            @if (isset($user))
              @if (isset($allowed) && $allowed)
                <li><a href="{{ route('organizer.manage', $conf->url) }}">Organizer Dashboard</a></li>
              @elseif (!$user->isAdmin())
                <li><a href="/users/home">User Dashboard</a></li>
              @endif
            @endif
          </ul>


          @if (isset($signedIn) && $signedIn)

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="glyphicon glyphicon-user"></i> {{ $user->title . " " . $user->last_name}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/logout"><i class="glyphicon glyphicon-logout"></i> Logout</a></li>
                </ul>
            </li>
          </ul>

          @endif
        </div><!--/.nav-collapse -->
      </div>
    </nav>
