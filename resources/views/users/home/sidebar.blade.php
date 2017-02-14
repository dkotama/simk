            @if($isAdmin == null && $isAdmin)
              <a href="/all" class="list-group-item list-group-item-success" style="text-align: center">Join New Conference</a>
            @endif

            @if(count($conferences) > 0)
              <hr>
              <strong><i class="glyphicon glyphicon-th-large"></i> Subscibed Conference</strong>
              <hr>

              <ul class="nav nav-pills nav-stacked">
                  <li class="nav-header"></li>
                      @foreach($conferences as $single)
                        <li><a href="{{ route('user.home.manage', $single->url) }}"><i class="glyphicon glyphicon-book"></i> {{ strtoupper($single->url) }}<span class="badge"></li>
                      @endforeach

  <!--  -->   </ul>

            @endif

            @if(count($conferencesOrganized) > 0)
              <hr>
              <strong><i class="glyphicon glyphicon-th-large"></i> Organized Conference</strong>
              <hr>

              <ul class="nav nav-pills nav-stacked">
                  <li class="nav-header"></li>
                      @foreach($conferencesOrganized as $single)
                        <li><a href="{{ route('organizer.manage', $single->url) }}"><i class="glyphicon glyphicon-book"></i> {{ strtoupper($single->url) }}<span class="badge"></li>
                      @endforeach

  <!--  -->   </ul>
            @endif
            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Preferences</strong></a>

            <hr>


            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('admin.user.all') }}"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
            </ul>
            <hr>
