@extends('users.home.index')

@section('content')
   <div class="row">
    @if(!$isParticipating)
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Your Papers on {{ $conf->name }} </strong>
              <a href="{{ route('user.home.addPaper', $conf->url) }}">
                <button type="button" class="btn btn-success btn-xs"
                {{ ($conf->isCanUpload()) ? NULL : " disabled"}}
                >Add Paper</button>
              </a>
                @if(!$conf->isCanUpload())
                  Uploading new paper disabled. Deadline passed.
                @endif
            </div>
            <div class="panel-body">
              <table class="table table-bordered conferences">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1 ?>
                  @forelse($submissions as $subs)
                    <tr>
                      <td>
                        {{ $count++ }}
                      </td>
                      <td class="title">
                        <a href="{{ route('user.home.single.show', ['conf' => $conf->url, 'paperId' => $subs->id]) }}"  data-toggle="tooltip" data-placement="top" title="{{ str_limit($subs->abstract, 100) }}">
                          {{ str_limit($subs->title, 70) }}
                        </a>
                      </td>
                      <td>
                        @foreach ($subs->authors as $author)
                          {{ $author->name }} ,
                        @endforeach
                      </td>
                      <td class="center">{{ $subs->getStatusFromAuthor() }}</td>
                      <td>
                        <button class="btn btn-danger btn-xs" onclick="confirmDelete({{ $subs->id }})">Cancel</button>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td>
                      </td>
                      <td class="title">
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    @endif
    @if(!$isRegisteredAuthor && !$isParticipating)
      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Participant Section</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-danger">
                    Please note. By registering as participant, you cannot upload papers as authors.</p>
                    <p>To Register, you just need to send the payment proof of participant registration below.
                  </p>
                </div>
                @if($appl != NULL && $appl->payment_notes != '')
                    <div class="col-md-12" style="padding-top:10px;">
                      <p>
                        <b>Notes From Organizer</b>
                        <br>{{ $appl->payment_notes }}
                      </p>
                    </div>
                  @endif
                @if($appl === NULL || $appl->payment_proof === '')
                <div class="col-md-12">
                  <form class="form form-vertical" action="{{ route('user.home.registerParticipant', $conf->url) }}" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="control-group">
                              <div class="form-group{{ $errors->has('payment_proof') ? ' has-error' : '' }}" >
                                  <label>Upload Payment Proof
                                      <br>
                                  </label>


                                  <div class="controls">
                                    <div class="col-md-5">
                                      <input type="file" class="form-control input-sm" name="payment_proof">
                                      <span class="help-block">
                                            <strong>Please upload file with .jpg/ .jpeg / .png / .bmp extension only.</strong>
                                      </span>
                                    </div>
                                    <div class="col-md-7">
                                      <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </form>
                      </div>
                    @else
                    <div class="col-md-12">
                      Participant Payment Proof Uploaded. Waiting Validation
                    </div>
                    @endif
              </div>
            </div>
        </div>
    </div>
    @endif

    @if($isParticipating)
      <div class="col-md-12">
        <p class="">You are a registered participants of this conference</p>
      </div>
    @endif
  </div>
  <style media="screen">
    table.conferences th {
      text-align: center;
    }
    table.conferences td.date {
      text-align: center;
    }
    table.conferences td.title{
      width: 30%;
    }
    table.conferences td.center{
      text-align: center;
    }
  </style>
@endsection

@section('scripts.footer')
<script>
  function confirmDelete(submissionId) {
    if (confirm('Are you sure want to delete ?')) {
      // console.log(true);
      window.location.href = "{{ asset('/') }}users/home/manage/{{ $conf->url }}/" + submissionId + "/cancel";
    }
  }

</script>
@endsection
