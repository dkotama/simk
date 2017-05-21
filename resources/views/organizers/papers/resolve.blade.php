@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                </div>
                <div class="panel-body">
                  @include('partials.singlepaper_content')
                  <div class="pull-right">
                      <strong>Status : {{ $submission->getLastPaperReadableStatus() }}</strong>
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
                  @if($submission->getLastPaper()->status === 'WAIT_ORG')
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="notes">Notes For Author:</label>
                      </div>
                      <div class="col-md-12">
                        <textarea id="notes" name="notes" rows="8" cols="80"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Resolve Camera Ready</button>
                      </div>
                    </div>
                  @else
                    <div class="form-group">
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Resolve</button>
                      </div>
                    </div>
                  @endif

                  </form>
                </div>
            </div>


        </div>
        </div>
        </div>
    </div>
@endsection
