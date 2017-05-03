@extends('organizers.dashboard')

@section('content')
  <div class="row">
        @include('partials.singlepaper')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>
                <div class="panel-body">
                  <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Phone</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($authors as $author)
                      <tr>
                        <td>
                          {{ $author->author_no}}
                        </td>
                        <td>
                          {{ $author->name }}
                          @if($author->is_primary)
                            <span class="label label-success">Contact Author</span>
                          @endif
                        </td>
                        <td>{{ $author->email }}</td>
                        <td>{{ $author->phone }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
            </div>


        </div>
        <div class="col-md-10">
          <div class="panel panel-default">
            <div class="panel-heading">
                Reviewers
                <a href="{{ route('organizer.paper.assignReviewer', ['confurl' => $conf->url, 'paperId' => $submission->id ])}}" class="btn btn-xs btn-primary">Assign New</a>
            </div>
              <div class="panel-body">
                  <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>{{ $questions->topic_a }}</th>
                      <th>{{ $questions->topic_b }}</th>
                      <th>{{ $questions->topic_c }}</th>
                      <th>{{ $questions->topic_d }}</th>
                      <th>{{ $questions->topic_e }}</th>
                      <th>Recommendation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1 ?>
                    @foreach($reviewers as $rev)
                      <tr>
                        <td>
                          <?php $scores = $rev->getScoresAsAlias($submission->id) ?>
                          {{ $count++ }}
                        </td>
                        <td>
                          {{ $rev->salutation . " " . $rev->last_name . " " . $rev->first_name }}
                        </td>
                        <td>
                          {{ $scores[0] }}
                        </td>
                        <td>
                          {{ $scores[1] }}
                        </td>
                        <td>
                          {{ $scores[2] }}
                        </td>
                        <td>
                          {{ $scores[3] }}
                        </td>
                        <td>
                          {{ $scores[4] }}
                        </td>
                        <td>
                          {{ $scores[5] }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>

              </div>
          </div>
        </div>
        </div>
    </div>
@endsection
