              <table class="table table-bordered users">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Institution</th>
                    @if (!empty($showAction) && $showAction)
                      <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 0 ?>
                  @foreach ($users as $user)
                  <?php $count++ ?>
                    <tr>
                      <td class="sm-size">

                      </td>
                      <td class="sm-size">
                        {{ $user->id }}
                      </td>
                      <td class="name">
                        <a href="{{ route($showRoute, $user->id) }}">
                          {{  $user->title . ' ' . $user->first_name . ' ' . $user->title }}
                        </a>
                      </td>
                      <td class="med-size">
                        Udayana University
                      </td>
                    @if (!empty($showAction) && $showAction)
                      <td class="action">
                        <a href="#" class="btn btn-primary btn-xs">Edit</a>
                        <a href="#" class="btn btn-danger btn-xs">Delete</a>
                      </td>
                    @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <center>
                {{ $users->links() }}
              </center>

              <style media="screen">
                table.users th {
                  text-align: center;
                }
                table.users td.sm-size{
                  width: 5%;
                  text-align: center;
                }
                table.users td.name {
                  /*width: 25%;*/
                  text-align: left;
                }
                table.users td.action{
                  width: 15%;
                  text-align: center;
                }
                table.users td.med-size{
                  width: 25%;
                  text-align: center;
                }
                table.users td.large-size{
                  width: 40%;
                  text-align: center;
                }
                table.users td.email{
                  width: 25%;
                  text-align: center;
                }
                table.users td.center{
                  text-align: center;
                }
              </style>
