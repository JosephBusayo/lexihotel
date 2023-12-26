<div id="activateModal{{ $booking->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          Activate Booking ({{ $booking->trx }})
        </h5>
        <button class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.booking.activate', $booking->uid) }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-12 mb-4">
              @php
                $amount = $booking->amount;
                $discount = App\Models\Discount::where('tracking_no', $booking->trx)->first();
                if ($discount) {
                    $amount -= $discount->amount;
                }
              @endphp
              <p>Paying: <strong class="font-weight-bold fs-24">{{ do_money($amount) }}</strong>
              </p>
              Are you sure you want to continue this process?
            </div>
            <hr>
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
    <script>
      const cash = $("#cash_inp");
      const pos = $("#pos_inp");
      const transfer = $("#transfer_inp");
      const paymentType = $('#payment_type')

      cash.closest('.col-md-4').hide()
      pos.closest('.col-md-4').hide()
      transfer.closest('.col-md-4').hide()

      paymentType.on('change', function() {

        let value = $.trim($(this).val())
        console.log(value);
        if (value == "cash") {

          cash.show();
          pos.hide();
          transfer.hide();

        } else if (value == "pos") {
          $("#cash_inp").hide();
          $("#pos_inp").show();
          $("#transfer_inp").hide();

        } else if (value == "transfer,pos") {
          $("#cash_inp").hide();
          $("#pos_inp").show();
          $("#transfer_inp").show();

        } else if (value == "cash,pos") {
          $("#cash_inp").show();
          $("#pos_inp").show();
          $("#transfer_inp").hide();

        } else if (value == "transfer,cash") {
          $("#cash_inp").show();
          $("#pos_inp").hide();
          $("#transfer_inp").show();

        } else if (value == "transfer") {
          $("#cash_inp").hide();
          $("#pos_inp").hide();
          $("#transfer_inp").show();
          $(".debtor_inp").hide();

        } else if (value == "transfer,cash,pos") {
          $("#pos_inp").show();
          $("#cash_inp").show();
          $("#transfer_inp").show();
        } else if (value == "complimentary") {
          $("#pos_inp").hide();
          $("#cash_inp").hide();
          $("#transfer_inp").hide();
        } else if (value == "debt") {
          $("#pos_inp").hide();
          $("#cash_inp").show();
          $("#transfer_inp").hide();
        }
      })
    </script>
  @endpush
