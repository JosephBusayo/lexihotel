@extends('layouts.app', ['page' => 'admin.bookings.list-reservation'])

@push('page-styles')
  <!-- DataTables -->
  <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
  <style>
    div#timer {
      display: inline-block;
      line-height: 1;
      padding: 10px;
    }

    #timer span {
      display: block;
      color: white;
    }

    #days {
      color: #db4844;
    }

    #hours {
      color: #f07c22;
    }

    #minutes {
      color: #f6da74;
    }

    #seconds {
      color: #abcd58;
    }
  </style>
@endpush

@section('content')
  @include('partial.breadcrumb')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ $pageTitle ?? '' }}
        </div>
        <div class="card-body">
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Cust. Name') }}</th>
                <th>{{ __('Cust. Mobile') }}</th>
                <th>{{ __('Room') }}</th>
                <th>{{ __('Checkin') }}</th>
                <th>{{ __('Checkout') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Days') }}</th>
                <th>{{ __('Actions') }}</th>
              </tr>
            </thead>

            <tbody>
              @php
                use Illuminate\Support\Carbon;
              @endphp
              @forelse ($bookings as $booking)
                @include('admin.bookings._activate_modal', ['booking' => $booking])
                @php
                  $checkinDate = Carbon::parse($booking->checkin)->startOfDay();
                  $checkoutDate = Carbon::parse($booking->checkout)->startOfDay();
                  $todayDate = Carbon::now()->startOfDay();
                @endphp
                <tr>
                  <td class="d-flex align-items-center">
                    <span> {{ $loop->index + 1 }}</span>

                    <span class="ms-1">
                      <input type="checkbox" name="drop" id="{{ $booking->id }}">
                    </span>
                  </td>
                  <td>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showModal{{ $booking->id }}">
                      {{ $booking->trx ?? '' }}
                    </a>

                    @include('admin.bookings._modal', ['booking' => $booking])
                  </td>
                  <td>{{ $booking->customer->name ?? '' }}</td>
                  <td>{{ $booking->customer->mobile ?? '' }}</td>
                  <td>{{ $booking->room->name ?? '' }}</td>
                  <td>{{ $booking->checkin }}/{{ $booking->created_at->format('h:i:s a') }}</td>
                  <td>{{ $booking->checkout }}</td>
                  <td>{{ do_money($booking->amount) }}</td>
                  <td>
                    @if ($checkinDate->isSameDay($todayDate))
                      <span class="badge bg-info px-2">
                        Checking In...
                        <i class="fa fa-spinner fa-spin ms-1" aria-hidden="true"></i>
                      </span>
                    @else
                      Reserved
                    @endif
                  </td>
                  <td>{{ $booking->duration }}</td>
                  <td>
                    <div class="d-flex">
                      <div class="dropdown mt-3 mt-sm-0">
                        <a class="btn btn-secondary dropdown-toggle" href="javascript:void(0);" id="dropdownMenuLink1"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Action
                          <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" data-popper-placement="top-start">
                          @if ($booking->status == 2)
                            <a class="dropdown-item" data-bs-toggle="modal"
                              data-bs-target="#cancelModal{{ $booking->id }}" data-bs-backdrop="static"
                              href="javascript:void(0)">Cancel Booking</a>
                            <a class="dropdown-item" data-bs-toggle="modal"
                              data-bs-target="#activateModal{{ $booking->id }}" data-bs-backdrop="static"
                              href="javascript:void(0)">Activate Booking</a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                @if ($booking->status == 2)
                  @include('admin.bookings._cancel_modal', ['booking' => $booking])
                @endif

              @empty
                <tr>
                  <td colspan="13">No Bookings Found</td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div class="d-flex mt-4 justify-content-end">
            <h2 class="text-success">Total Amount: {{ do_money($bookings->sum('amount')) }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->

  <!-- END wrapper -->
@endsection

@push('page-scripts')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

  <!-- Datatable init js -->
  <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

  <script>
    $(function() {
      const checkoutBtn = $('#checkout');
      checkoutBtn.on('click', function() {
        // make ajax request
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.booking.ajax.checkout-room') }}",
          data: {
            '_token': $("input[name=_token]").val(),
            'uid': $(this).attr('data-id'),
            type: 'html'
          },
          beforeSend: function() {
            checkoutBtn.attr('disabled', true)
          },
          dataType: "html",
          success: function(res) {
            checkoutBtn.attr('disabled', true)
            data = JSON.parse(res)
            if (data.msg == "notdue") {
              iziToast.warning({
                message: "Rooms not overdue",
                position: "topRight"
              });
            } else if (data.msg == "debt") {
              iziToast.warning({
                message: "This transaction has a pending debt to be settled",
                position: "topRight"
              });
            } else {
              iziToast.success({
                message: "Rooms checkout successfully",
                position: "topRight"
              });
            }
            // $('#result').html(output);
            // console.log(res);
          }
        });
      })

      const cancelBtn = $('#cancel');
      cancelBtn.on('click', function() {
        // make ajax request
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.booking.ajax.cancel-room') }}",
          data: {
            '_token': $("input[name=_token]").val(),
            'uid': $(this).attr('data-id'),
            type: 'html'
          },
          beforeSend: function() {
            cancelBtn.attr('disabled', true)
          },
          dataType: "html",
          success: function(res) {
            cancelBtn.attr('disabled', true)
            data = JSON.parse(res)
            if (data.msg == "unavailable") {
              iziToast.warning({
                message: "",
                position: "topRight"
              });
            } else if (data.msg == "success") {
              iziToast.success({
                message: "Rooms cancel successfully",
                position: "topRight"
              });
            }
            // $('#result').html(output);
            console.log(res);
          }
        });
      })


    })
  </script>
@endpush
