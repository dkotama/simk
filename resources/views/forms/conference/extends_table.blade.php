                  <table class="table table-striped conferences">
                      <thead>
                        <tr>
                          <th>Deadline</th>
                          <th>Acceptance</th>
                          <th>Camera Ready</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Visibility</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              use Carbon\Carbon;
                              $carbon = new Carbon;
                              $count  = 0;
                            ?>
                            @foreach($dates as $date)
                            <tr>
                              <td class="date">
                                {{ $carbon::parse($date->submission_deadline)->toFormattedDateString() }}
                              </td>
                              <td class="date">
                                {{ $carbon::parse($date->acceptance)->toFormattedDateString() }}
                              </td>
                              <td class="date">
                                {{ $carbon::parse($date->camera_ready)->toFormattedDateString() }}
                              </td>
                              <td class="date">
                                {{ $carbon::parse($date->start_conference)->toFormattedDateString() }}
                              </td>
                              <td class="date">
                                {{ $carbon::parse($date->end_conference)->toFormattedDateString() }}
                              </td>
                              <td class="date">
                                <input type="checkbox" name="visible[{{ $date->id }}]" {{ ($date->is_visible === 1) ? " checked" : NULL }}>
                              </td>
                            </tr>
                            <?php $count++ ?>
                          @endforeach
                      </tbody>
                    </table>
