@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                  <div class="pull-right">
                    @if($submission->getStatusCode() === 'WAIT_REV')
                      <a href="{{ route('organizer.paper.resolve', ['confUrl' => $conf->url, 'paperId' => $submission->id])}}" class="btn btn-xs btn-success">Resolve Submission</a>
                    @endif
                  </div>
                </div>
                <div class="panel-body">
                    @include('partials.singlepaper_content')
                    <div class="row" style="padding-top:30px;">
                      <div class="col-md-12">
                        <b>1st Version:</b>&nbsp;<a href="/uploads/{{ $submission->getLastPaper()->path }}" class="btn btn-primary btn-xs">Download</a>

                      </div>
                      <div class="col-md-12" style="padding-top:10px;">
                        @if($submission->getLastPaper()->blind_version === '')
                          <form class="form form-vertical" action="{{ route('organizer.paper.postBlind', ['confUrl' => $conf->url, 'paperId' => $submission->id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <div class="form-group{{ $errors->has('paper') ? ' has-error' : '' }}" >
                                    <label>Blind Paper Upload
                                        <br>
                                    </label>
                                    <div class="controls">
                                      <div class="col-md-5">
                                        <input type="file" class="form-control input-sm" name="paper">
                                        @if ($errors->has('paper'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('paper') }}</strong>
                                            </span>
                                        @else
                                            <span class="help-block">
                                                <strong>Please upload file with .doc / .docx extension only.</strong>
                                            </span>
                                        @endif
                                      </div>
                                      <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-sm">Set Blind Paper</button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </form>
                        @else
                          <b>1st Version (Blind Mode):</b>&nbsp;<a href="/uploads/{{ $submission->getLastPaper()->blind_version }}" class="btn btn-primary btn-xs">Download</a>
                        @endif
                      </div>
                    </div>

                </div>
            </div>
        </div>
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
                <a href="{{ route('organizer.paper.assignReviewer', ['confurl' => $conf->url, 'paperId' => $submission->id ])}}" class="btn btn-xs btn-primary" {{ (!$submission->isCanAssignReviewer()) ? " disabled" : NULL }}>Assign New</a>
                {{ (!$submission->isCanAssignReviewer()) ? "Please upload blind version first." : NULL }}
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
