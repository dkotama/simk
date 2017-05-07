                        <div class="form-group{{ $errors->has('start_conference') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Conference Start</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="start_conference" value="{{ isset($edited['start_conference']) ? $edited['start_conference'] : old('start_conference') }}">

                                @if ($errors->has('start_conference'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_conference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('conference_end') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Conference End</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="end_conference" value="{{ isset($edited['end_conference']) ? $edited['end_conference'] : old('end_conference') }}">

                                @if ($errors->has('conference_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('conference_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Deadline Dates</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('submission_deadline') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Submission</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="submission_deadline" value="{{ isset($edited['submission_deadline']) ? $edited['submission_deadline'] : old('submission_deadline') }}">

                                @if ($errors->has('submission_deadline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('submission_deadline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('acceptance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Acceptance</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="acceptance" value="{{ isset($edited['acceptance']) ? $edited['acceptance'] : old('acceptance') }}">

                                @if ($errors->has('acceptance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('acceptance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('camera_ready') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Camera Ready</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="camera_ready" {{ isset($edited['camera_ready']) ? $edited['camera_ready'] : old('camera_ready') }}>

                                @if ($errors->has('camera_ready'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('camera_ready') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registration') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Registration</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="registration">

                                @if ($errors->has('registration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
