@extends('organizers.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit Questions</strong>
            </div>
            <div class="panel-body">
              <form action="#" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="text-center" style="padding-bottom:20px;">
                    QUESTION 1
                </div>

                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Topic</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qa" value="{{ $questions->topic_a }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qa">
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
                    <input type="text" class="form-control" id="topic-qb" size="5">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qb" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qb">
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
                    <input type="text" class="form-control" id="topic-qc" size="5">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qc" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qc">
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
                    <input type="text" class="form-control" id="topic-qd" size="5">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qd" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qd">
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
                    <input type="text" class="form-control" id="topic-qe" size="5">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qe" class="col-sm-1 control-label">Questions</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="question-qe">
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
