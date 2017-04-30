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
                Review Paper
            </div>
            <div class="panel-body">
              <form action="" method="post">
                <div class="form-group">
                  <p>1. {{ $questions->question_a }}</p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($answers as $ans)
                    <label class="radio-inline">
                      <input type="radio" name="question_a" value="{{ $count++ }}"> {{ $ans }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>2. {{ $questions->question_b }}</p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($answers as $ans)
                    <label class="radio-inline">
                      <input type="radio" name="question_b" value="{{ $count++ }}"> {{ $ans }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>3. {{ $questions->question_c }}</p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($answers as $ans)
                    <label class="radio-inline">
                      <input type="radio" name="question_c" value="{{ $count++ }}"> {{ $ans }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>4. {{ $questions->question_d }}</p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($answers as $ans)
                    <label class="radio-inline">
                      <input type="radio" name="question_d" value="{{ $count++ }}"> {{ $ans }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>5. {{ $questions->question_e }}</p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($answers as $ans)
                    <label class="radio-inline">
                      <input type="radio" name="question_e" value="{{ $count++ }}"> {{ $ans }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>6. Recommendation </p>
                  <div class="text-center">
                    <?php $count = 0 ?>
                    @foreach($recommendations as $recs)
                    <label class="radio-inline">
                      <input type="radio" name="question_f" value="{{ $count++ }}"> {{ $recs }}
                    </label>
                    @endforeach
                  </div>
                </div>

                <div class="form-group">
                  <p>7. Comments</p>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </form>
            </div>
          </div>
        </div>
  </div>
@endsection
