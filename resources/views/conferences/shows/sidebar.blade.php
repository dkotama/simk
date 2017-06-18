          <div class="list-group">
            <a href="{{ $joinUrl }}" class="list-group-item list-group-item-success" style="text-align: center">{{ $joinText }}</a>
          </div>

          <div class="panel panel-warning">
              <div class="panel-heading">
                Important Dates
              </div>
              <div class="panel-body">
                  <strong>Submission</strong>
                    <div style="padding-left:10px">
                      02-May-2017
                    </div>
                  <strong>Acceptance</strong>
                    <div style="padding-left:10px">
                      02-May-2017
                    </div>
                  <strong>Camera Ready</strong>
                    <div style="padding-left:10px">
                      02-May-2017
                    </div>
                  <strong>Event Start</strong>
                    <div style="padding-left:10px">
                      02-May-2017
                    </div>
                  <strong>Event End</strong>
                    <div style="padding-left:10px">
                      02-May-2017
                    </div>
              </div>
          </div>
          <div class="list-group">
            <a href="/{{ $conf->url }}" class="list-group-item {{ $active == 'home' ? 'active' : null}}">
              <i class="fa fa-home fa-fw"></i> {{ strtoupper($conf->url) }} Home
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
          </div>
