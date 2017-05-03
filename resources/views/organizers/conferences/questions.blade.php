@extends('organizers.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit Questions</strong>
            </div>
            <div class="panel-body">
              <form action="{{ route('organizer.manage.updateQuestions', ['confUrl' => $conf->url, 'questionId' => $questions->id]) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="text-center" style="padding-bottom:20px;">
                    QUESTION 1
                </div>

                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qa" value="{{ $questions->topic_a }}" name="topic_a">
                  </div>
                </div>
                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qa" value="{{ $questions->question_a }}" name="question_a">
                  </div>
                </div>

                <hr>
                <div class="text-center">
                    QUESTION 2
                </div>
                <hr>
                <div class="form-group">
                  <label for="topic-qb" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qb" value="{{ $questions->topic_b }}" name="topic_b">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qb" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qb" value="{{ $questions->question_b }}" name="question_b">
                  </div>
                </div>

                <hr>
                <div class="text-center">
                    QUESTION 3
                </div>
                <hr>
                <div class="form-group">
                  <label for="topic-qc" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qc" value="{{ $questions->topic_c }}" name="topic_c">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qc" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qc" value="{{ $questions->question_c }}" name="question_c">
                  </div>
                </div>

                <hr>
                <div class="text-center">
                    QUESTION 4
                </div>
                <hr>
                <div class="form-group">
                  <label for="topic-qd" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qd" value="{{ $questions->topic_d }}" name="topic_d">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qd" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qd" value="{{ $questions->question_d }}" name="question_d">
                  </div>
                </div>

                <hr>
                <div class="text-center">
                    QUESTION 5
                </div>
                <hr>
                <div class="form-group">
                  <label for="topic-qe" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qe" value="{{ $questions->topic_e }}" name="topic_e">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qe" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qe" value="{{ $questions->question_e}}" name="question_e">
                  </div>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
@endsection
