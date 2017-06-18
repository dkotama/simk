@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                  <div class="pull-right">
                    @if($submission->getStatusCode() === 'WAIT_REV' || $submission->getStatusCode() === 'WAIT_ORG')
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
                        @if($submission->getMainPaper()->blind_version === '')
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
                          <b>1st Version (Blind Mode):</b>&nbsp;<a href="/uploads/{{ $submission->getMainPaper()->blind_version }}" class="btn btn-primary btn-xs">Download</a>
                        @endif
                      </div>

                        @foreach($versions as $ver)
                         @if($ver->version > 1)
                          <div class="col-md-12" style="padding-top:10px;">
                              <b>Camera Ready Version {{ $ver->version - 1 }}:</b>&nbsp;<a href="/uploads/{{ $submission->getLastPaper()->path}}" class="btn btn-primary btn-xs">Download</a>
                          </div>
                         @endif
                        @endforeach
                    </div>
                  <div class="row">
                    <div class="col-md-12" style="padding-top:10px;">
                      <div class="pull-right">
                        <strong>Status : {{ $submission->getLastPaperReadableStatus() }}</strong>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        @if($submission->getStatusCode() === 'WAIT_ORG_PAY')
        <div class="col-md-10">
          <div class="panel panel-default">
              <div class="panel-heading">
                Payment Section
              </div>
              <div class="panel-body">
                  <div class="col-md-12" style="padding-top:10px;">
                    <b>Payment Proof</b>
                    <a href="/payment/{{ $submission->payment_proof }}" class="thumbnail">
                      <img src="/payment/{{ $submission->payment_proof }}" alt="Payment Proof">
                    </a>
                  </div>

                  <div class="col-md-12" style="padding-top:10px;">
                  <form class="form-vertical" action="{{ route('organizer.paper.postValidation', ['confUrl' => $conf->url, 'paperId' => $submission->id]) }}" method="post">
                    <div style="padding-left:20px;">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="radio">
                            <label>
                              <input type="radio" value="REGISTERED"  name="validation" checked> Approve
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" value="WAIT_PAY"  name="validation"> Reject
                            </label>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="payment_notes">Notes For Author:</label>
                      </div>
                      <div class="col-md-12">
                        <textarea id="payment_notes" name="payment_notes" rows="8" cols="80"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Validate</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
          </div>
        </div>
        @endif

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
                {{ (!$submission->getLastPaper()->status === 'WAIT_BLIND') ? "Please upload blind version first." : NULL }}
                {{ ($submission->isPaperResolved()) ? "Paper Already Resolved" : NULL }}
                <a href="{{ route('organizer.paper.showAllReview', ['confurl' => $conf->url, 'paperId' => $submission->id ])}}" class="btn btn-xs btn-primary pull-right" }>Show All Review</a>
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
                    <?php $revAlias = [
                        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
                        'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
                        'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
                      ];?>
                    <?php $count = 1 ?>
                    @foreach($reviewers as $rev)
                      <tr>
                        <td>
                          <?php $scores = $rev->getScoresAsAlias($submission->id) ?>
                          {{ $count++ }}
                        </td>
                        <td>
                          <a href="{{ route('organizer.paper.showSingleReview', ['confUrl' => $conf->url, 'paperId' => $submission->id, 'reviewerId' => $rev->id])}}">
                            {{ $rev->salutation . " " . $rev->last_name . " " . $rev->first_name}}
                          </a>({{ $revAlias[$count-2]}})
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
