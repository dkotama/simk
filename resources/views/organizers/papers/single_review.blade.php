@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Review by : {{ $reviewer->salutation . " " . $reviewer->last_name . ", " . $reviewer->first_name}}
                </div>
                <?php $scores = $reviewer->getScoresAsAlias($submission->id) ?>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      1. {{ $questions->question_a }}
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[0] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      2. {{ $questions->question_b }}
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[1] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      3. {{ $questions->question_c }}
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[2] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      4. {{ $questions->question_d }}
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[3] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      5. {{ $questions->question_e }}
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[4] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      6. Reccomendation
                    </div>
                    <div class="col-md-12" style="padding-left:50px;">
                      <b>{{ $scores[5] }}</b>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-1">
                      Comments
                    </div>
                    <div class="col-md-11" style="padding-left:30px">
                      {{ $reviews->comments }}
                    </div>
                  </div>
                </div>
            </div> <!-- panel end -->
        </div>
</div>
@endsection
