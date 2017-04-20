@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                </div>
                <div class="panel-body">
                  <h4><strong>{{ $submission->title }}</strong></h4>
                  <p>
                    <strong>Keywords:</strong>
                    {{ $submission->keywords }}
                  </p>
                  <p>
                    <strong>Abstract:</strong>
                    <br>{{ $submission->abstract }}
                  </p>


                  <p>
                      <strong>File Version {{ $submission->active_version }} :</strong>
                      <a href="/uploads/{{ $submission->getCurrentActivePath() }}" class="btn btn-sm btn-default">Download</a>
                  </p>
                  <div class="pull-right">
                      <strong>Status : On Review</strong>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
          <div class="panel panel-default">
              <div class="panel-heading">All Reviewers Registered</div>
              <div class="panel-body">
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reviewers as $rev)
                    <tr>
                      <td>
                        {{ $rev->salutation . " " . $rev->last_name . " " . $rev->first_name }}
                        @if($rev->isReviewingPaper($submission->id))
                          <a href=""><div class="label label-primary">reviewing</div></a>
                        @endif
                      </td>
                      <td>
                        @if(!$rev->isReviewingPaper($submission->id))
                          <a href=""><div class="btn btn-sm btn-primary">Set as Paper Reviewer</div></a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
          </div>
        </div>
  </div>
@endsection
