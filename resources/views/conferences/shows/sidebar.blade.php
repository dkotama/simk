          <div class="list-group">
            <a href="/{{ $conf->url }}" class="list-group-item {{ $active == 'home' ? 'active' : null}}">
              <i class="fa fa-home fa-fw"></i> {{$conf->name }} Home
            </a>
            <a href="/{{ $conf->url }}/callpaper" class="list-group-item {{ $active == 'callpaper' ? 'active' : null }}">
              <i class="fa fa-book fa-fw"></i> Call For Papers <span class="label label-warning">!</span>
            </a>
            <a href="/{{ $conf->url }}/policies" class="list-group-item {{ $active == 'policies' ? 'active' : null }}">
              <i class="fa fa-gavel fa-fw"></i> Track Policies
            </a>
            <a href="#" class="list-group-item">
              <i class="fa fa-tv fa-fw"></i> Presentations
            </a>
            <a href="#" class="list-group-item">
              <i class="fa fa-calendar fa-fw"></i> Schedule
            </a>
            <a href="#" class="list-group-item">
              <i class="fa fa-hotel fa-fw"></i> Accomodation
            </a>
            <a href="#" class="list-group-item">
              <i class="fa fa-list-ol fa-fw"></i>Timeline
            </a>
          </div>    