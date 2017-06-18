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
              <li><a href="{{ route('organizer.allPapers', $conf->url)}}"><i class="glyphicon glyphicon-list-alt"></i> Submissions</a></li>
                @if(isset($paperSelected))
                  <ul class="nav nav-pills nav-stacked" style="padding-left:20px;">
                    <li class="{{ ($paperSelected === 'onprogress') ? 'active' : NULL}}"><a href="{{ route('organizer.allPapers', $conf->url) }}"><i class="glyphicon glyphicon-chevron-right"></i> On Progress</a></li>
                    <li class="{{ ($paperSelected === 'proceeding') ? 'active' : NULL}}"><a href="{{ route('organizer.proceeding', $conf->url) }}"><i class="glyphicon glyphicon-chevron-right"></i> Proceeding</a></li>
                  </ul>
                @endif
              <li><a href="{{ route('organizer.manage.show', $conf->url) }}"><i class="glyphicon glyphicon-cog"></i> Manage Conference</a></li>
                @if(isset($manageSelected))
                  <ul class="nav nav-pills nav-stacked" style="padding-left:20px;">
                    <li class="{{ ($manageSelected === 'conference') ? 'active' : NULL}}"><a href="{{ route('organizer.manage.show', $conf->url) }}"><i class="glyphicon glyphicon-chevron-right"></i> Conferences</a></li>
                    <li class="{{ ($manageSelected === 'question') ? 'active' : NULL}}"><a href="{{ route('organizer.manage.questions', $conf->url) }}"><i class="glyphicon glyphicon-chevron-right"></i> Questions</a></li>
                  </ul>
                @endif
              <li><a href="{{ route('organizer.manage.manageWeb', $conf->url) }}"><i class="glyphicon glyphicon-link"></i> Website Management</a></li>
            </ul>

            <hr>
