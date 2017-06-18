@extends('organizers.dashboard')

@section('content')
   <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>All Papers on {{ $conf->name }} </strong>
            </div>
            <div class="panel-body">
              <table class="table table-bordered conferences">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Reviewer</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1 ?>
                  @forelse($submissions as $subs)
                   @if($subs->getStatusCode() != 'REGISTERED' && !$subs->uploader->isParticipating($conf))
                    <tr>
                      <td>
                        {{ $count++ }}
                      </td>
                      <td>
                        {{ $subs->id }}
                      </td>
                      <td class="title">
                        <a href="{{ route('organizer.paper.showSingle', ['conf' => $conf->url, 'paperId' => $subs->id]) }}"  data-toggle="tooltip" data-placement="top" title="{{ str_limit($subs->abstract, 100) }}">
                          {{ str_limit($subs->title, 70) }}
                        </a>
                        @if ($subs->isDeleted())
                          <span class="label label-danger">Canceled</span>
                        @endif
                      </td>
                      <td>
                        @foreach ($subs->reviewers as $revs)
                          {{ $revs->last_name . " " . $revs->first_name}} ,
                        @endforeach
                      </td>
                      <td class="center">{{ $subs->getStatus() }}</td>
                      <td>

                        @if ($subs->isDeleted())
                          <button class="btn btn-success btn-xs" onclick="confirmRestore({{ $subs->id }})">Restore</button>
                        @else
                          <button class="btn btn-danger btn-xs" onclick="confirmDelete({{ $subs->id }})">Cancel</button>
                        @endif
                      </td>
                    </tr>
                    @endif
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
