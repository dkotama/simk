@extends('organizers.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit Website</strong>
            </div>
            <div class="panel-body">
              <form action="{{ route('organizer.manage.updateQuestions', ['confUrl' => $conf->url, 'questionId' => $questions->id]) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Overview</label>
                  <div class="col-sm-11">
                   <textarea name="description" id="description" class="form-control" rows="3">{{ isset($edited['description']) ? $edited['description'] : old('description') }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Track Policies</label>
                  <div class="col-sm-11">
                    <textarea name="description" id="description" class="form-control" rows="3">{{ isset($edited['description']) ? $edited['description'] : old('description') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>

                <hr>
                <div class="col-md-12 text-center" style="padding-top:20px">
                    <h3>
                    Articles
                    </h3>
                </div>
                <hr>
                <div class="form-group">
                  <label for="topic-qb" class="col-sm-1 control-label">Title</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" id="topic-qb" value="{{ $questions->topic_b }}" name="topic_b">
                  </div>
                </div>
                <div class="form-group">
                  <label for="question-qb" class="col-sm-1 control-label">Content</label>
                  <div class="col-sm-11">
                    <textarea name="description" id="description" class="form-control" rows="3">{{ isset($edited['description']) ? $edited['description'] : old('description') }}</textarea>
                  </div>
                </div>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Add Article</button>
                </div>

              </form>
            </div>
        </div>
    </div>
  </div>
@endsection
