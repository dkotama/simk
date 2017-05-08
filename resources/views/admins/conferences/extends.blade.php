@extends('admins.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Extends Date</div>
                <div class="panel-body">
                  <form class="" action="{{ route('admin.conf.postExtends', $conf->url)}}" method="post">
                    {{ csrf_field() }}
                      <input type="checkbox" name="visible[12]" checked>
                      <input type="checkbox" name="visible[2]">
                      <input type="checkbox" name="visible[14]">

                      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
