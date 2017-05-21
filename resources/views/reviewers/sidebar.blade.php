            <a href="#"><strong><i class="glyphicon glyphicon-th-large"></i> Reviewers Menu</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{ route('reviewer.papers', $conf->url )}}"><i class="glyphicon glyphicon-list-alt"></i> Waiting Review</a></li>
              <li><a href="{{ route('reviewer.papers.reviewed', $conf->url )}}"><i class="glyphicon glyphicon-list-alt"></i> Reviewed Paper</a></li>
            </ul>

            <hr>
