@extends('users.home.index')

@section('content')
  <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Submission ID: {{ $submission->id }}
                  <a href="#" class="btn btn-xs btn-primary">Edit</a>
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
                <div class="panel-heading">Authors</div>
                <div class="panel-body">
                  <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($authors as $author)
                      <tr>
                        <td>
                          {{ $author->name }}
                          @if($author->is_primary)
                            <span class="label label-success">Contact Author</span>
                          @endif
                        </td>
                        <td>{{ $author->email }}</td>
                        <td>{{ $author->phone }}</td>
                        <td>
                          <a href="{{ route('user.home.single.editAuthor', [
                              'conf' => $conf->url,
                              'paperId' => $submission->id,
                              'authorId' => $author->id
                          ])}}" class="btn btn-xs btn-primary">Edit</a>

                          @if(!$author->is_primary)
                            <a href="{{ route('user.home.single.changeContact', [
                              'conf' => $conf->url,
                              'paperId' => $submission->id,
                              'authorId' => $author->id
                            ])}}" class="btn btn-xs btn-success">Set as Contact</a>

                            <a href="{{ route('user.home.single.removeAuthor', [
                              'conf' => $conf->url,
                              'paperId' => $submission->id,
                              'authorId' => $author->id
                            ])}}" class="btn btn-xs btn-danger">Delete</a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">Add More Author</div>
                <div class="panel-body">
                  @if (isset($edit))
                   <form class="form-horizontal" role="form" method="POST" action="{{ route('user.home.single.updateAuthor', ['conf' => $conf->url, 'paperId' => $submission->id, 'authorId' => $author->id]) }}">
                  @else
                   <form class="form-horizontal" role="form" method="POST" action="{{ route('user.home.single.addAuthor', ['conf' => $conf->url, 'paperId' => $submission->id]) }}">
                  @endif
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                @if (old('name') !== NULL)
                                  <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @elseif(isset($edit))
                                  <input type="text" class="form-control" name="name" value="{{ $singleAuthor->name }}">
                                @else
                                  <input type="text" class="form-control" name="name" value="">
                                @endif

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                @if (old('email') !== NULL)
                                  <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                @elseif(isset($edit))
                                  <input type="text" class="form-control" name="email" value="{{ $singleAuthor->email }}">
                                @else
                                  <input type="text" class="form-control" name="email" value="">
                                @endif

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone No.</label>

                            <div class="col-md-6">
                                @if (old('phone') !== NULL)
                                  <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                @elseif(isset($edit))
                                  <input type="text" class="form-control" name="phone" value="{{ $singleAuthor->phone }}">
                                @else
                                  <input type="text" class="form-control" name="phone" value="">
                                @endif

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-7">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i> {{ (isset($edit)) ? "Update" : "Add Author" }}
                                </button>

                                @if(isset($edit))
                                <a href="#" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Cancel Edit
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
