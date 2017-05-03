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
                <div class="panel-heading">Resolve Decision</div>
                <div class="panel-body">
                  <p>What do you want to do with this submission ?</p>
                  <form class="" action="{{ route('organizer.paper.postresolve', ['confUrl' => $conf->url, 'paperId' => $submission->id]) }}" method="post">
                    <div style="padding-left:20px;">
                    {{ csrf_field() }}
                      <div class="form-group">
                      @foreach($aliases as $key => $alias)
                          <div class="radio">
                            <label>
                              <input type="radio" value="{{ $key }}"  name="status"
                                {{ ($key == 'REV_MIN') ? ' checked' : NULL }}
                              > {{ $alias }}
                            </label>
                          </div>
                      @endforeach
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Resolve</button>
                    </div>
                  </div>

                  </form>
                </div>
            </div>


        </div>
        </div>
        </div>
    </div>
@endsection
