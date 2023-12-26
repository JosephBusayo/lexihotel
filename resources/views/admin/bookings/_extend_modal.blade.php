<div id="extend{{ $booking->uid }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          Payment For Booking ({{ $booking->trx }})
        </h5>
        <button class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('admin.booking.pay-debt', $booking->uid) }}" method="post">
          @csrf
          {{-- booking details --}}
          <h4>Booking Details</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Room
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    {{ $booking->room->name ?? null }}
                  </span>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    CheckIn Date
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    {{ $booking->checkin }}
                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    CheckOut Date
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    {{ $booking->checkout }}
                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              @php
                $amountQuery = App\Models\Discount::where('tracking_no', $booking->trx)->first();
              @endphp
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Subtotal
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    @if ($amountQuery)
                      @php
                        $total = $booking->amount + $amountQuery->amount;
                      @endphp
                      {{ do_money($total) }}
                    @else
                      @php
                        $total = $booking->amount;
                      @endphp
                      {{ do_money($booking->amount) }}
                    @endif

                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Discount
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    @if ($amountQuery)
                      {{ do_money($amountQuery->amount) }}
                    @else
                      <span class="badge bg-danger px-2">No</span>
                    @endif

                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block" style="font-size: 1.2rem; font-weight: 600">
                    Total
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block" style="font-size: 1.2rem; font-weight: 600">
                    @php
                      if ($amountQuery) {
                          $totalAmount = $total - $amountQuery->amount;
                      } else {
                          $totalAmount = 0;
                      }
                      
                    @endphp
                    {{ do_money($totalAmount) }}

                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Amounts Paid
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    @php
                      $amountQuery = App\Models\Payment::where('trx', $booking->uid)->sum('amount');
                    @endphp
                    {{ do_money($amountQuery ?? 0) }}
                  </span>
                </div>
              </div>

            </li>

            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block" style="font-size: 1.2rem; font-weight: 600">
                    Debt to Pay
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    @php
                      $debtQuery = App\Models\Debt::where('tracking_no', $booking->trx)->first();
                    @endphp
                    @if ($debtQuery)
                      {{ do_money($debtQuery->amount - $debtQuery->amount_paid) }}
                    @else
                      <span class="badge bg-danger px-2">No</span>
                    @endif

                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Receptionist
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    {{ $booking->user->username ?? null }}
                  </span>
                </div>
              </div>

            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-5">
                  <span class="d-block">
                    Booking Time
                  </span>
                </div>
                <div class="col-md-7">
                  <span class="d-block font-weight-bold">
                    {{ $booking->created_at->format('h:i:s a') ?? null }}
                  </span>
                </div>
              </div>

            </li>
          </ul>
          <hr>
          <div class="row mt-4">
            <div class="mb-3 col-md-12">
              <label for="payment_type">Payment Type</label>
              <select id="payment_type" class="form-control @error('payment_type') is-invalid @enderror"
                name="payment_type">
                <option value="" selected>{{ __('Select payment type') }}</option>
                <option value="debt">{{ __('Debt') }}</option>
                @foreach (paymentType() as $item)
                  <option value="{{ toLower($item) }}">{{ $item }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 mb-3" id="transfer_inp">
              <label class="" for="transfer">Transfer</label>
              <input name="transaction[transfer]" type="number" class="form-control" id="transfer" placeholder="0"
                value="">
            </div>

            <div class="col-md-4 mb-3" id="cash_inp">
              <label class="" for="cash_r">Cash</label>
              <input name="transaction[cash]" type="number" class="form-control" id="cash" placeholder="0"
                value="">
            </div>

            <div class="col-md-4 mb-3" id="pos_inp">
              <label class="" for="pos">POS</label>
              <input name="transaction[pos]" type="number" class="form-control" id="pos" placeholder="0"
                value="">
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-primary" type="submit">Proceed</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>


      </div>
    </div>
  </div>

  @push('page-scripts')
  @endpush
