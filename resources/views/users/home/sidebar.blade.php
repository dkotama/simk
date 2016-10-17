            <a href="/all" class="list-group-item list-group-item-success" style="text-align: center">Join New Conference</a>

            <hr>
            <strong><i class="glyphicon glyphicon-th-large"></i> Subscibed Conference</strong> 
            <hr>

            <ul class="nav nav-pills nav-stacked">
                <li class="nav-header"></li>
                @if(count($conferences) > 0) 
                    @foreach($conferences as $single)
                      <li><a href="{{ route('user.home.manage', $single->url) }}"><i class="glyphicon glyphicon-book"></i> {{ strtoupper($single->url) }}<span class="badge"></li>
                    @endforeach
                @endif
                
<!--  -->   </ul>

            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Preferences</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('admin.user.all') }}"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
            </ul>

            <hr>
