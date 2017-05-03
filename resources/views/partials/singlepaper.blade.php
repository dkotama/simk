  <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                  <div class="pull-right">
                    @if($submission->getStatusCode() === 'ON_REV')
                      <a href="{{ route('organizer.paper.resolve', ['confUrl' => $conf->url, 'paperId' => $submission->id])}}" class="btn btn-xs btn-success">Resolve Submission</a>
                    @endif
                  </div>
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
                      <?php
                        $count   = 1;
                        $service = new App\SubmissionService();
                      ?>
                      <strong>File Version:</strong>
                        @foreach($submission->versions as $vers)
                          @if($vers->status === 'ON_REV')
                            <br>Version {{ $count++ }} : <a href="/uploads/{{ $submission->getCurrentActivePath() }}" class="btn btn-xs btn-default">Download</a>
                          @else
                            <br>Version {{ $count++ }} : {{ $service->getPaperAlias($vers->status) }}
                          @endif
                        @endforeach
                  </p>
                </div>
            </div>
        </div>
