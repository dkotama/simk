                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <select class="form-control" name="country" id="country">
                                    <option selected disabled>Please Choose Country</option>
                                  @foreach($countryList as $countryKey => $countryValue)
                                    @if (isset($editedUser))
                                      <option {{ ($countryKey === $editedUser->country) ? 'selected ' : NULL }} value="{{ $countryKey }}">{{ $countryValue }}</option>
                                    @elseif (old('country') !== NULL)
                                      <option {{ ($countryKey === old('country')) ? 'selected ' : NULL }} value="{{ $countryKey }}">{{ $countryValue }}</option>
                                    @else
                                      <option value="{{ $countryKey }}">{{ $countryValue }}</option>
                                    @endif
                                  @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('salutation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Salutation</label>

                            <div class="col-md-6">
                                <select class="form-control" name="salutation" id="salutation">
                                    <option selected disabled>Please Choose Salutation</option>
                                    @if (isset($editedUser->salutation) || old('salutation') !== NULL)
                                      <option value="Mr." {{ ($editedUser->salutation === 'Mr.'|| old('salutation') === 'Mr.') ? 'selected' : null }}>Mr.</option>
                                      <option value="Mrs." {{ ($editedUser->salutation === 'Mrs.'|| old('salutation') === 'Mrs.') ? 'selected' : null }}>Mrs.</option>
                                      <option value="Ms." {{ ($editedUser->salutation === 'Ms.'|| old('salutation') === 'Ms.') ? 'selected' : null }}>Ms.</option>
                                      <option value="Dr." {{ ($editedUser->salutation === 'Dr.'|| old('salutation') === 'Dr.') ? 'selected' : null }}>Dr.</option>
                                      <option value="Prof." {{ ($editedUser->salutation === 'Prof.'|| old('salutation') === 'Prof.') ? 'selected' : null }}>Prof.</option>
                                    @else
                                      <option value="Mr.">Mr.</option>
                                      <option value="Mrs.">Mrs.</option>
                                      <option value="Ms.">Ms.</option>
                                      <option value="Dr.">Dr.</option>
                                      <option value="Prof.">Prof.</option>
                                    @endif
                                </select>

                                @if ($errors->has('salutation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salutation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    <option selected disabled>Please Choose Status</option>
                                    @if (isset($editedUser->status) || old('salutation') !== NULL)
                                      <option value="Student" {{ ($editedUser->status === 'Student' || old('status') === 'Student') ? 'selected' : Null}}>Student</option>
                                      <option value="Academia" {{ ($editedUser->status === 'Academia' || old('status') === 'Academia') ? 'selected' : Null}}>Academia</option>
                                      <option value="Industry" {{ ($editedUser->status === 'Industry' || old('status') === 'Industry') ? 'selected' : Null}}>Industry</option>
                                      <option value="Goverment" {{ ($editedUser->status === 'Goverment'|| old('status') === 'Goverment') ? 'selected' : Null}}>Goverment</option>
                                      <option value="Other" {{ ($editedUser->status === 'Other'|| old('status') === 'Other') ? 'selected' : Null}}>Other</option>
                                    @else
                                    <option value="Student">Student</option>
                                    <option value="Academia">Academia</option>
                                    <option value="Industry">Industry</option>
                                    <option value="Goverment">Goverment</option>
                                    <option value="Other">Other</option>
                                    @endif
                                </select>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                @if (isset($editedUser))
                                  <input type="text" class="form-control" name="first_name" value="{{ $editedUser->first_name }}">
                                @else
                                  <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                @endif

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                @if (isset($editedUser))
                                  <input type="text" class="form-control" name="last_name" value="{{ $editedUser->last_name}}">
                                @else
                                  <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                @endif

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                @if (isset($editedUser))
                                  <textarea name="address" id="address" class="form-control" rows="3">{{ $editedUser->address}}</textarea>
                                @else
                                  <textarea name="address" id="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                                @endif

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                @if (isset($editedUser))
                                  <input type="email" class="form-control" name="email" value="{{ $editedUser->email}}">
                                @else
                                  <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @endif

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
