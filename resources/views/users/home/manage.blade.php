@extends('users.home.index')

@section('content')
   <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Your Papers on {{ $conf->name }} </strong>
              <a href="{{ route('user.home.addPaper', $conf->url) }}">
                <button type="button" class="btn btn-success btn-xs">Add Paper</button>
              </a>
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
                    <tr>
                      <td>
                        1
                      </td>
                      <td class="title">
                        <a href="#"  data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolor sit lisuor amor">
                          Analisa Tegangan Pada Sutet yang Mempengaruhi Probabilitas Kekuatan Arus 
                        </a>
                      </td>
                      <td>
                        Jonathan, Pardede; Christina, Aguilera; Richard, Mathew; Albert, Santoso
                      </td>
                      <td class="center"> Review Process</td>
                      <td>
                        <button class="btn btn-danger btn-xs">Delete</button>
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
