          <div class="list-group">
            <a href="{{ $joinUrl }}" class="list-group-item list-group-item-success" style="text-align: center">{{ $joinText }}</a>
          </div>

          <div class="list-group">
            <a href="/{{ $conf->url }}" class="list-group-item {{ $active == 'home' ? 'active' : null}}">
              <i class="fa fa-home fa-fw"></i> {{ strtoupper($conf->url) }} Home
            </a>
            <!-- <a href="/{{ $conf->url }}/callpaper" class="list-group-item {{ $active == 'callpaper' ? 'active' : null }}">
              <i class="fa fa-book fa-fw"></i> Call For Papers <span class="label label-warning">!</span>
            </a> -->
            <a href="/{{ $conf->url }}/policies" class="list-group-item {{ $active == 'policies' ? 'active' : null }}">
              <i class="fa fa-gavel fa-fw"></i> Track Policies
            </a>
            <a href="/{{ $conf->url }}/help-author" class="list-group-item {{ $active == 'helpa' ? 'active' : null }}">
            <i class="fa fa-question-circle" aria-hidden="true"></i> Author Guidelines
            </a>
            <a href="/{{ $conf->url }}/help-participant" class="list-group-item {{ $active == 'helpp' ? 'active' : null }}">
              <i class="fa fa-question-circle" aria-hidden="true"></i> Participant Guidelines
            </a>
          </div>
          <div class="panel panel-warning">
              <div class="panel-heading">
                Important Dates
              </div>
              <div class="panel-body">

                  <strong>Submission</strong>
                    <div style="padding-left:30px">
                    <?php $count = 0 ?>
                      @foreach($dates['submission_deadline'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                    </div>
                  <strong>Acceptance</strong>
                    <div style="padding-left:30px">
                    <?php $count = 0 ?>
                    @foreach($dates['acceptance'] as $date)
                        <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                        <br>
                    @endforeach
                    </div>
                  <strong>Camera Ready</strong>
                    <div style="padding-left:30px">
                      <?php $count = 0 ?>
                      @foreach($dates['camera_ready'] as $date)
                          <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                          <br>
                      @endforeach
                    </div>
                    <strong>Registration</strong>
                    <div style="padding-left:30px">
                    <?php $count = 0 ?>
                    @foreach($dates['registration'] as $date)
                        <{{ $date['tag'] }}>{{ $date['date'] }}</{{ $date['tag'] }}>
                        <br>
                    @endforeach
                    </div>

                  <?php $lastIndex = count($dates['submission_deadline']) - 1 ?>
                  <strong>Event Start</strong>
                    <div style="padding-left:30px">
                      {{ $dates['start_conference'][$lastIndex]['date'] }}
                    </div>
                  <strong>Event End</strong>
                    <div style="padding-left:30px">
                      {{ $dates['end_conference'][$lastIndex]['date'] }}
                    </div>
              </div>
          </div>
