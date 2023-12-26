<div id="showModal{{ $booking->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          Transaction Detail ({{ $booking->trx }})
        </h5>
        <button class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-7">
            <h4 class="mb-2">Booking Details</h4>
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
                    <span class="d-block">
                      Debt
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
                      Clear Debt
                    </span>
                  </div>
                  <div class="col-md-7">
                    <span class="d-block font-weight-bold">
                      @php
                        $debtQuery = App\Models\Debt::where('tracking_no', $booking->trx)->first();
                      @endphp
                      @if ($debtQuery)
                        @if ($debtQuery->cleared)
                          <span class="badge bg-success px-2">Yes</span>
                        @else
                          <span class="badge bg-danger px-2">No</span>
                        @endif

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
          </div>
          <div class="col-md-5">
            <h4 class="mb-2">Customer Details</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="row">
                  <div class="col-md-6">
                    <span class="d-block">
                      Customer Name
                    </span>
                  </div>
                  <div class="col-md-6">
                    <span class="d-block font-weight-bold">
                      {{ $booking->customer->name ?? null }}
                    </span>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-md-6">
                    <span class="d-block">
                      Customer Mobile
                    </span>
                  </div>
                  <div class="col-md-6">
                    <span class="d-block font-weight-bold">
                      {{ $booking->customer->mobile ?? null }}
                    </span>
                  </div>
                </div>

              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-md-6">
                    <span class="d-block">
                      Customer Address
                    </span>
                  </div>
                  <div class="col-md-6">
                    <span class="d-block font-weight-bold">
                      {{ $booking->customer->address ?? null }}
                    </span>
                  </div>
                </div>

              </li>
            </ul>
          </div>
          <div class="col-md-12 mt-5">
            @if ($booking->status == 4)
              <div class="alert alert-info" role="alert">
                This booking was canceled
              </div>
            @elseif($booking->status == 1)
              <a target="_blank" href="{{ route('admin.booking.receipt', $booking->uid) }}"
                class="btn btn-primary btn-lg">Print
                Receipt</a>
              <button class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancel</button>
            @endif

          </div>
        </div>

      </div>
    </div>
  </div>
