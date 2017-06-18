@extends('organizers.dashboard')

@section('content')
  <div class="row">
        <div class="col-md-10">
          <div class="panel panel-default">
              <div class="panel-heading">
                Participant Payment
              </div>
              <div class="panel-body">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-2"><b>Full Name</b></div>
                      <div class="col-sm-10">: {{  $showUser->salutation. ' ' . $showUser->last_name . ' ' . $showUser->first_name}}</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><b>Country</b></div>
                      <div class="col-sm-10">: {{ $userCountry }}</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><b>Status</b></div>
                      <div class="col-sm-10">: {{ $showUser->status }}</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><b>Email</b></div>
                      <div class="col-sm-10">: {{ $showUser->email }}</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><b>Address</b></div>
                      <div class="col-sm-10">: {{ $showUser->address }}</div>
                    </div>
                  </div>
                  @if($showUser->isPaymentProofExist($conf->id) && !$showUser->isParticipating($conf))
                  <div class="col-md-12" style="padding-top:10px;">
                    <b>Payment Proof</b>
                    <a href="/payment/{{ $participantAppl->payment_proof }}" class="thumbnail">
                      <img src="/payment/{{ $participantAppl->payment_proof }}" alt="Payment Proof">
                    </a>
                  </div>

                  <div class="col-md-12" style="padding-top:10px;">
                  <form class="form-vertical" action="{{ route('organizer.postParticipant', ['confUrl' => $conf->url, 'userId' => $showUser->id])}}" method="post">
                    <div style="padding-left:20px;">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="radio">
                            <label>
                              <input type="radio" value="ACCEPT"  name="validation" checked> Approve
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" value="REJECT"  name="validation"> Reject
                            </label>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="payment_notes">Notes For Author:</label>
                      </div>
                      <div class="col-md-12">
                        <textarea id="payment_notes" name="payment_notes" rows="8" cols="80">{{($participantAppl->payment_notes != '') ? $participantAppl->payment_notes : NULL}}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Validate</button>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                  <div class="col-md-3 col-md-offset-5" style="padding-top:20px">
                    <a href="{{ route('organizer.allUser', $conf->url) }}" class="btn btn-primary">Back</a>
                  </div>
                @endif
              </div>
          </div>
        </div>

    </div>
@endsection
