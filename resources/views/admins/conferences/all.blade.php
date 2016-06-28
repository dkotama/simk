@extends('admins.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">All Conferences</div>
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
                  <tr>
                    <td>
                      1
                    </td>
                    <td class="title">
                      <a href="#"  data-toggle="tooltip" data-placement="top" title="
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua">
                        International Electrical And Informatics Conferences
                      </a>
                    </td>
                    <td class="center">
                      <a href="/admin/conferences/eic">satu</a>
                    </td>
                    <td class="date">
                      3 June 2016
                    </td>
                    <td class="date">
                      3 June 2016
                    </td>
                    <td class="date">
                      3 June 2016
                    </td>
                    <td class="date">
                      3 June 2016
                    </td>
                  </tr>
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
