@extends('organizers.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit Website</strong>
            </div>
            <div class="panel-body">
              <form action="{{ route('organizer.manage.postManageWeb', $conf->url) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Overview</label>
                  <div class="col-sm-11">
                   <textarea name="overview" id="overview" class="form-control" rows="3">{{ $website->overview }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="topic-qa" class="col-sm-1 control-label">Track Policies</label>
                  <div class="col-sm-11">
                    <textarea name="policies" id="policies" class="form-control" rows="3">{{ $website->policies }}</textarea>
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
