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
                <form class="form form-vertical" @submit.prevent="">
                    <div class="control-group">
                        <label>Title
                            <br>
                        </label>
                        <div class="controls">
                            <input type="text" class="form-control" placeholder="Enter Paper Title">
                        </div>
                    </div>
                    <div class="control-group">
                        <label>Abstract</label>
                        <div class="controls">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label>Keywords</label>
                        <div class="controls">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label>Category</label>
                        <div class="controls">
                            <select class="form-control" id="paper-cat">
                                <option>options</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label>File Upload
                            <br>
                        </label>
                        <div class="controls">
                            <input type="file" class="form-control input-sm">
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
                                <input type="text" class="form-control" placeholder="Enter Author Name" value="@{{ author.name }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Institution</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Institution">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Email</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Phone Number</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter Phone Number">
                            </div>
                        </div>       
                    <hr /> 
                    </div>
                    <div class="control-group">
                        <label></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Upload Paper</button>
                            <button class="btn pull-right btn-info"
                                @click="addAuthor" 
                            >Add More Author</button>
                        </div>
                    </div>
                </form>
            </div>
        <!--/panel content-->
    </div>
</div>
@endsection
