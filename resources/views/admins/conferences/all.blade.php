@extends('admins.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>All Conferences</strong>
              <a href="{{ route('admin.conf.new') }}">
                <button type="button" class="btn btn-success btn-xs">Add Conference</button>
              </a>
            </div>
            <div class="panel-body">
              <table class="table table-bordered conferences">
                <thead>
                  <tr class="text-center">
                    <th rowspan="2">#</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">URL</th>
                    <th colspan="2">Submission</th>
                    <th colspan="2">Event</th>
                  </tr>
                  <tr>
                    <!-- <th></th> -->
                    <!-- <th></th> -->
                    <th>Start</th>
                    <th>End</th>
                    <th>Start</th>
                    <th>End</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($confs as $conf)
                    <tr>
                      <td>
                        {{ $conf->id }}
                      </td>
                      <td class="title">
                        <a href="#"  data-toggle="tooltip" data-placement="top" title="{{$conf->description}}">
                          {{$conf->name}}
                        </a>
                      </td>
                      <td class="center">
                        <a href="{{ route('admin.conf.show', $conf->url) }}">{{$conf->url}}</a>
                      </td>
                      <td class="date">
                        {{ null !== $conf->start_submit ? date('d F Y', strtotime($conf->start_submit)) : null }}
                      </td>
                      <td class="date">
                        {{ null !== $conf->end_submit ? date('d F Y', strtotime($conf->end_submit)) : null }}
                      </td>
                      <td class="date">
                        {{ null !== $conf->start_date ? date('d F Y', strtotime($conf->start_date)) : null }}
                      </td>
                      <td class="date">
                        {{ null !== $conf->start_submit ? date('d F Y', strtotime($conf->start_submit)) : null }}
                      </td>
                    </tr>
                  @endforeach
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
