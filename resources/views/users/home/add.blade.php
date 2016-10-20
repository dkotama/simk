@extends('users.home.index')

@section('content')
  <div class="row">
        <div class="col-md-10">
          <div class="row">
              <div class="row bs-wizard" style="border-bottom:0; margin-left: 30%;">
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Register As Author</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Paper Upload & Revision</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Payment</div>
                </div>                
            </div>
        </div>
        <div class="panel panel-default col-md-offset-2">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                    <h4>Upload Paper</h4>
                </div>
            </div>
            <div class="panel-body">
                <form class="form form-vertical" method="post" action="{{ route('user.home.addPaper.submit', $conf->url) }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label>Title</label>

                        <div class="controls">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group{{ $errors->has('abstract') ? ' has-error' : '' }}">
                            <label>Abstract</label>
                            <div class="controls">
                                <textarea class="form-control" name="abstract">{{ old('abstract') }}</textarea>

                                @if ($errors->has('abstract'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abstract') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                            <label>Keywords</label>
                            <div class="controls">
                                <textarea class="form-control" name="keywords">{{ old('keywords') }}</textarea>
                                <span class="help-block">
                                    @if ($errors->has('keywords'))
                                       <strong>{{ $errors->first('keywords') }}</strong>
                                    @else
                                        <i>separate keywords by comma; e.g: Clean Energy, New Energy</i>
                                    @endif
                                </span>
                            </div>
                        <div> 
                    </div>
                    <div class="control-group">
                        <div class="form-group{{ $errors->has('paper') ? ' has-error' : '' }}">
                            <label>File Upload
                                <br>
                            </label>
                            <div class="controls">
                                <input type="file" class="form-control input-sm" name="paper">
                                @if ($errors->has('paper'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('paper') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr />
                      <h4 class="text-center">Author</h4>
                    <hr /> 
                    <div v-for="author in authors">
                       <div class="control-group">
                            <label>Name
                                <br>
                            </label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Author Name" name="author-name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Institution</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Institution" name="author-institution">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Email</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Email" name="author-email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Phone Number</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Phone Number" name="author-phone">
                            </div>
                        </div>       
                    <hr /> 
                    </div>
                    <div class="control-group">
                        <label></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Upload Paper</button>
                        </div>
                    </div>
                </form>
            </div>
        <!--/panel content-->
    </div>
</div>
@endsection
