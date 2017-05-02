@extends('reviewers.dashboard')

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
            <div class="panel-heading">
              Questions
            </div>
            <div class="panel-body">
              <form action="{{ route('reviewer.postReview' ,['confUrl' => $conf->url, 'paperId' => $submission->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <p>1. {{ $questions->question_a }}</p>
                    <?php $count = 0 ?>
                    <div style="padding-left:20px;">
                    @foreach($answers as $ans)
                    <div class="radio">
                      <label>
                        <input type="radio" name="score_a" value="{{ $count++}}"
                        {{ ($count === 2) ? " checked" : NULL }}
                        > {{ $ans }}
                      </label>
                    </div>
                    @endforeach
                    </div>
                </div>



                <div class="form-group">
                  <p>2. {{ $questions->question_b }}</p>
                    <?php $count = 0 ?>
                    <div style="padding-left:20px;">
                    @foreach($answers as $ans)
                    <div class="radio">
                      <label>
                        <input type="radio" name="score_b" value="{{ $count++ }}"
                        {{ ($count === 2) ? " checked" : NULL }}
                        > {{ $ans }}
                      </label>
                    </div>
                    @endforeach
                    </div>
                </div>

                <div class="form-group">
                  <p>3. {{ $questions->question_c }}</p>
                  <?php $count = 0 ?>
                  <div style="padding-left:20px;">
                  @foreach($answers as $ans)
                  <div class="radio">
                    <label>
                      <input type="radio" name="score_c" value="{{ $count++}}"
                        {{ ($count === 2) ? " checked" : NULL }}
                      > {{ $ans }}
                    </label>
                  </div>
                  @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>4. {{ $questions->question_d }}</p>
                    <?php $count = 0 ?>
                    <div style="padding-left:20px;">
                    @foreach($answers as $ans)
                    <div class="radio">
                      <label>
                        <input type="radio" name="score_d" value="{{ $count++}}"
                        {{ ($count === 2) ? " checked" : NULL }}
                        > {{ $ans }}
                      </label>
                    </div>
                    @endforeach
                    </div>
                </div>

                <div class="form-group">
                  <p>5. {{ $questions->question_e }}</p>
                    <?php $count = 0 ?>
                    <div style="padding-left:20px;">
                    @foreach($answers as $ans)
                    <div class="radio">
                      <label>
                        <input type="radio" name="score_e" value="{{ $count++}}"
                        {{ ($count === 2) ? " checked" : NULL }}
                        > {{ $ans }}
                      </label>
                    </div>
                    @endforeach
                    </div>
                </div>

                <div class="form-group">
                  <p>6. Recommendation </p>
                    <div style="padding-left:20px;">
                    <?php $count = 0 ?>
                    @foreach($recommendations as $recs)
                    <div class="radio">
                      <label>
                        <input type="radio" name="score_f" value="{{ $count++ }}"
                        {{ ($count === 2) ? " checked" : NULL }}
                        > {{ $recs }}

                      </label>
                    </div>
                    @endforeach
                    </div>
                </div>

                <div class="form-group">
                  <p>7. Comments</p>
                  <textarea name="comments" class="form-control" rows="7"></textarea>
                </div>

                <div class="form-group">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
  </div>
@endsection
