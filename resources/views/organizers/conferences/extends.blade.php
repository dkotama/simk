@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Extends Date</div>
                <div class="panel-body">
                  <form action="{{ route('organizer.manage.updateVisibility', $conf->url)}}" method="post">
                    {{ csrf_field() }}
                    @include('forms.conference.extends_table');
                    <div class="form-group{{ $errors->has('minimal') ? ' has-error' : '' }} text-center">
                      @if ($errors->has('minimal'))
                          <span class="help-block">
                              <strong>{{ $errors->first('minimal') }}</strong>
                          </span>
                      @endif
                      <button type="submit" class="btn btn-primary btn-sm">Update Visibilty</button>
                    </div>
                  </form>

                  <hr>


                  <form class="form-horizontal" action="{{ route('organizer.manage.postExtends', $conf->url)}}" method="post">
                    {{ csrf_field() }}
                    @include('forms.conference.dates')
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-user"></i>Create New Dates
                            </button>
                            <a href="{{ route('admin.conf.show', $conf->url) }}"<button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i>Back
                            </button></a>
                        </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
