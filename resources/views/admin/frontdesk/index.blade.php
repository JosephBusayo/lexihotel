@extends('layouts.app', ['page' => 'admin.frontdesk'])

@push('page-styles')
  <style>
    .room-box {
      padding: 10px !important;
    }
  </style>
@endpush

@section('content')
  @include('partial.breadcrumb')

  <div class="row">
    @foreach ($floors as $floor)
      <div class="col-md-12 mb-4" style="border-bottom: 1px solid #eee;">
        <h6>Building: <span class="text-warning me-2">{{ $floor->building->name ?? null }};</span>Floor name: <span
            class="text-success me-2">{{ $floor->name ?? null }};</span> Total room: <span
            class="text-danger">{{ $floor->room->count() }}</span>
        </h6>
      </div>
      @foreach ($floor->room->all() as $room)
        <div class="col-lg-2-5 col-md-3 col-md-2">
          <div class="card mini-stat"
            style="background: @if ($room->is_booked == 0 && $room->is_clean == true) #279B0A @endif @if ($room->is_booked == 0 && $room->is_clean == false) brown @endif @if ($room->is_booked == 1) #E96D3A @endif @if ($room->is_booked == 2) #DAA520 @endif !important">
            <div class="card-body room-box mini-stat-img">
              <div class="text-white">
                <div class="d-flex justify-content-between">
                  <div>
                    <h6 class="text-uppercase mb-2">{{ $room->name }}</h6>
                    <span class="badge badge-info">{{ do_money($room->category->price ?? null) }} </span>
                  </div>

                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="mdi mdi-dots-horizontal" style="color: #fff;"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" style="">
                      @if ($room->is_booked == 1)
                        @php
                          $booking = App\Models\Booking::where('room_id', $room->id)->first();
                          if ($booking) {
                              $debt = App\Models\Debt::where('tracking_no', $booking->trx)
                                  ->where('cleared', 0)
                                  ->first();
                          }
                        @endphp
                        @if ($debt)
                          <a class="dropdown-item pay-debt" href="javascript:void(0)" data-id="{{ $debt->id }}">Pay
                            Debt</a>
                        @endif
                        <a class="dropdown-item view-room" href="javascript:void(0)" data-id="{{ $room->id }}">View
                          Detail</a>
                        <a class="dropdown-item checkout-room" href="javascript:void(0)"
                          data-id="{{ $room->id }}">Checkout Room</a>
                        <a class="dropdown-item cancel-room" href="javascript:void(0)"
                          data-id="{{ $room->id }}">Cancel</a>
                      @endif

                      @if (!$room->is_clean)
                        <a class="dropdown-item clean-room" data-id="{{ $room->uid }}" href="javascript:void(0)">Clean
                          Room</a>
                      @endif
                      <a class="dropdown-item" target="_blank" href="{{ route('admin.room.edit', $room->uid) }}">View
                        Room</a>
                    </div>
                  </div>

                </div>
                <div class="d-flex mb-2">
                  <h6 class="text-uppercase me-3">{{ $room->category->name ?? null }}
                  </h6>
                  @if (!$room->is_clean)
                    <small class="text-warning">Untidy</small>
                  @endif
                </div>
                @can('frontdesk-book')
                  <div class="d-grid">
                    <a href="{{ route('admin.booking.index', $room->uid) }}"
                      class="btn btn-sm @if ($room->is_booked == 1) disabled @endif btn-primary book_btn"
                      id="booking_id">Book Now</a>
                  </div>
                @endcan
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
  <!-- end row -->
  <div id="viewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">
            Transaction Detail
          </h5>
          <button class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="viewResult"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="cancelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">
            Cancel Booking
          </h5>
          <button class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="cancelResult"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="checkoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">
            Checkout Booking
          </h5>
          <button class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="checkoutResult"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="cleanModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">
            Clean Room
          </h5>
          <button class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="cleanResult"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="payDebtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">
            Pay debt
          </h5>
          <button class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="payDebtResult"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- END wrapper -->
@endsection

@push('page-scripts')
  <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

  <script>
    function getRooms() {
      $.ajax({
        type: 'GET',
        url: "{{ route('ajax.get-room') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          data = JSON.parse(res)
          console.log(data);
          let output = ``;
          if (!data.msg) {
            iziToast.success({
              message: "Rooms updated successfully",
              position: "topRight"
            });
            if (data.floors.length > 0) {
              for (let floor of data.floors) {
                let rooms = [];
                let i = 1;
                rooms = data.all_room.filter(inv => inv.floor_id == floor.id);
                output +=
                  `<div class="col-md-12 mb-4" style="border-bottom: 1px solid #eee;">
                    <h6>Building: <span class="text-warning me-2">${floor.building.name};</span>Floor name: <span class="text-success me-2">${floor.name};</span> Total room: <span class="text-danger">${rooms.length}</span> </h6>
                    </div>`;

                for (let room of rooms) {
                  let statusColor = '#279B0A';
                  let btnStatus = '';
                  let btnName = 'Book Room'
                  if (room.is_booked == 1) {
                    statusColor = '#E96D3A';
                    btnStatus = 'disabled';
                    btnName = 'Booked'
                  } else if (room.is_booked == 2) {
                    statusColor = 'gold';
                    btnStatus = '';
                    btnName = 'Reserved'

                  }

                  output += `<div class="col-lg-2-5 col-md-3 col-md-2">
                            <div class="card mini-stat" style="background: ${statusColor} !important">
                              <div class="card-body room-box mini-stat-img">
                                <div class="text-white">
                                  <div class="d-flex justify-content-between">
                                    <h6 class="text-uppercase mb-2">${room.name}</'/h6>
                                    <span class="badge badge-info">${money(room.category.price)} </span>
                                  </div>
                                  <h6 class="text-uppercase mb-2">${room.category.name}</h6>
                                  
                                  <div class="d-grid">
                                    <button type="button" data-id="${room.uid}"class="btn btn-sm btn-primary book_btn" ${btnStatus} id="bookbtn${room.uid}" onClick="bookRoom('${room.uid}')">${btnName}</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>`
                }

              }
            }

          }
          $('#result').html(output);
          console.log(data);
        }
      });


    }
    // getRooms();

    var bookBtn = $(".book_btn");


    $(".view-room").on('click', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $.ajax({
        type: 'POST',
        url: "{{ route('ajax.booking-detail') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'id': id,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          $("#viewModal").modal('show');
          $('#viewResult').html(res);
        }
      });
    })

    $(".cancel-room").on('click', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $.ajax({
        type: 'POST',
        url: "{{ route('admin.booking.get-cancel-room') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'id': id,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          $("#cancelModal").modal('show');
          $('#cancelResult').html(res);
        }
      });
    })

    $(".checkout-room").on('click', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $.ajax({
        type: 'POST',
        url: "{{ route('admin.booking.ajax.checkout-room') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'id': id,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          $("#checkoutModal").modal('show');
          $('#checkoutResult').html(res);
        }
      });
    })

    $(".clean-room").on('click', function(e) {
      e.preventDefault();
      let uid = $(this).attr('data-id');
      $.ajax({
        type: 'POST',
        url: "{{ route('admin.booking.ajax.clean-room') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'uid': uid,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          $("#cleanModal").modal('show');
          $('#cleanResult').html(res);
        }
      });
    })

    $(".pay-debt").on('click', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $.ajax({
        type: 'POST',
        url: "{{ route('admin.booking.ajax.pay-debt') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'id': id,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          $("#payDebtModal").modal('show');
          $('#payDebtResult').html(res);
        }
      });
    })

    function bookRoom(uid) {

      $(document).find('#bookbtn' + uid).attr('disabled', true);
      $(document).find('#bookbtn' + uid).text('booking...');
      console.log(uid);
      setTimeout(() => {
        $(document).find('#bookbtn' + uid).attr('disabled', false);
        $(document).find('#bookbtn' + uid).text('Book Room');
        window.location.href = 'booking/room/' + uid;
      }, 2000);
    }

    function money(value = 0) {
      let format = parseFloat(value).toFixed(2)
      return '₦' + format;
    }
  </script>
@endpush
