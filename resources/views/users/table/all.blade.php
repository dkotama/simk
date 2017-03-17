              <table class="table table-bordered users">
                <thead>
                  <tr class="text-center">
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Status</th>
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
                        {{ $user->id }}
                      </td>
                      <td class="name">
                        <a href="{{ route($showRoute, $user->id) }}">
                          {{  $user->salutation. ' ' . $user->last_name . ' ' . $user->first_name}}
                        </a>
                      </td>
                      <td class="sm-size">
                          {{ $user->status }}
                      </td>
                    @if (!empty($showAction) && $showAction)
                      <td class="action">
                        <a href="{{ route($showRoute, ['userId' => $user->id]) }}" class="btn btn-success btn-xs">Show</a>
                        <a href="{{ route($editRoute, ['userId' => $user->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route($deleteRoute, ['userId' => $user->id]) }}" class="btn btn-danger btn-xs">Delete</a>
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
                  width: 40%;
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
