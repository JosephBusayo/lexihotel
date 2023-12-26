@extends('layouts.app', ['page' => 'admin.frontdesk'])

@push('page-styles')
  <style>
    .room-box {
      padding: 10px !important;
    }
  </style>
  <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
  @include('partial.breadcrumb')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-3">Booking Room</h4>
          <form action="{{ route('admin.booking.store', $room->uid) }}" method="POST" class=""
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="per_night" name="per_night" value="{{ $room->category->price }}">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="date_in">Checkin Date</label>
                <div class="input-group" id="datepicker1">
                  <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd"
                    data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' id="checkin" name="checkin">
                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div><!-- input-group -->
              </div>
              <div class="mb-3 col-md-6">
                <label for="date_out">Checkout Date</label>
                <div class="input-group" id="datepicker2">
                  <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd"
                    data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' id="checkout" name="checkout">
                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div><!-- input-group -->
              </div>
              <div class="mb-3 col-md-12">
                <h4 class="card-title mt-4 text-danger">Customer Info:</h4>
              </div>
              <div class="mb-3 col-md-6">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name">
              </div>
              <div class="mb-3 col-md-6">
                <label for="customer_mobile">Customer Mobile</label>
                <input type="text" class="form-control" id="customer_mobile" name="customer_mobile">
              </div>
              <div class="mb-3 col-md-12">
                <label for="customer_address">Customer Address (optional)</label>
                <input type="text" class="form-control" id="customer_address" name="customer_address">
              </div>
              <div class="mb-3 col-md-12">
                <label for="booking_option">Booking Option</label>
                <select id="booking_option" class="form-control @error('booking_option') is-invalid @enderror"
                  name="booking_option">
                  <option value="" selected>{{ __('Select Booking option') }}</option>
                  <option value="checkin">Checkin</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                  <input type="checkbox" class="form-check-input" name="applydebt" id="applydebt">
                  <label class="form-check-label" for="applydebt">Issue Debt? </label>
                </div>
              </div>
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

            </div>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          Booking Details
        </div>
        <div class="card-body">
          <div class="mb-3 col-md-12">
            <label for="duration">Duration (days)</label>
            <input type="text" class="form-control" id="duration" name="duration" readonly>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
              <input type="checkbox" class="form-check-input" name="applydiscount" id="applydiscount">
              <label class="form-check-label" for="applydiscount">Apply Discount </label>
            </div>
          </div>
          <div class="mb-3 col-md-12">
            <label for="discount">Discount Amount</label>
            <input type="number" class="form-control" id="discount" value="" name="discount">
          </div>

          <div class="col-md-12">
            <table class="table mb-3">
              <tbody>
                <tr>
                  <td class="thick-line text-center">
                    <strong>Subtotal</strong>
                  </td>
                  <td class="thick-line text-end" id="subtotal"></td>
                </tr>
                <tr>
                  <td class="thick-line text-center">
                    <strong>Discount</strong>
                  </td>
                  <td class="thick-line text-end" id="discount">0.00
                </tr>
                <tr>
                  <td class="no-line text-center">
                    <strong>Total</strong>
                  </td>
                  <td class="no-line text-end">
                    <h4 class="m-0" id="total"></h4>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit Request</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->

  <!-- END wrapper -->
@endsection

@push('page-scripts')
  <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
  <script>
    $(function() {
      $(".datepicker").datepicker({
        startDate: "{{ date('Y-m-d', strtotime(businessDay()->current_date)) }}",
        todayHighlight: true,
      });

      console.log("{{ date('Y-m-d', strtotime(businessDay()->current_date)) }}");

    })
    const bookBtn = $(".book_btn");

    function money(value = 0) {
      let format = parseFloat(value).toFixed(2)
      return '₦' + format;
    }
    const checkIn = $('#checkin');
    const checkout = $('#checkout');

    const subtotal = $('#subtotal');
    const total = $('#total');
    const perNight = $('#per_night');

    subtotal.text(money())
    total.text(money())

    checkout.on('change', (e) => {
      e.preventDefault();
      let duration = calculateDays(checkIn.val(), checkout.val())
      $('#duration').val(duration)
      let subtotalAmount = money(parseInt(perNight.val()) * parseInt(duration))
      subtotal.text(subtotalAmount)
      total.text(subtotalAmount)
      iziToast.success({
        message: "Prices updated successfully",
        position: "topRight"
      });
    })

    function calculateDays(checkIn, checkout) {
      console.log(checkIn);
      console.log(checkout);
      let diff = new Date(Date.parse(checkout) - Date.parse(checkIn));
      // get days
      let days = diff / 1000 / 60 / 60 / 24;
      return days;
      // console.log(days);
    }
    const cash = $("#cash_inp");
    const pos = $("#pos_inp");
    const transfer = $("#transfer_inp");

    const paymentType = $('#payment_type')
    const bookingOption = $('#booking_option')

    cash.closest('.col-md-4').hide()
    pos.closest('.col-md-4').hide()
    transfer.closest('.col-md-4').hide()

    paymentType.closest('.col-md-12').hide()

    bookingOption.on('change', function(e) {
      e.preventDefault();
      let value = $.trim($(this).val());
      if (value == 'checkin') {
        paymentType.closest('.col-md-12').fadeIn();
      } else if (value == 'reserved') {
        paymentType.closest('.col-md-12').fadeIn()
      } else {
        paymentType.closest('.col-md-12').hide()
      }
    })

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
      }
    })

    const discount = $('#discount');
    discount.closest('.col-md-12').hide();

    $('#checkbox1').change(function() {
      if (this.checked) {
        var returnVal = confirm("Are you sure?");
        $(this).prop("checked", returnVal);
      }
      $('#textbox1').val(this.checked);
    });

    const applyDiscount = $('#applydiscount')
    applyDiscount.on('change', function() {
      if (this.checked) {
        discount.closest('.col-md-12').fadeIn();
      } else {
        discount.closest('.col-md-12').hide();
      }

    })
  </script>
@endpush
