@extends('layouts.app', ['page' => 'admin.dashboard'])

@section('content')
  <div class="container-fluid">

    @include('partial.breadcrumb')

    <div class="row">
      <div class="col-xl-3 col-md-6">
        <div class="card mini-stat" style="background:#279B0A !important">
          <div class="card-body mini-stat-img">
            <div class="mini-stat-icon">
              <i class="mdi mdi-cube-outline float-right"></i>
            </div>
            <div class="text-white">
              <h6 class="text-uppercase mb-3">Sales</h6>
              <h3 class="mb-0" id="">
                {{ do_money($totalSales) }}
              </h3>
              <!--                                         <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card mini-stat" style="background:#D0A710 !important">
          <div class="card-body mini-stat-img">
            <div class="mini-stat-icon">
              <i class="mdi mdi-buffer float-right"></i>
            </div>
            <div class="text-white">
              <h6 class="text-uppercase mb-3">Total CheckedIn</h6>
              <h3 class="mb-0" id="load_profit">{{ $totalCheckedIn }}</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card mini-stat" style="background:#E96D3A !important">
          <div class="card-body mini-stat-img">
            <div class="mini-stat-icon">
              <i class="mdi mdi-tag-text-outline float-right"></i>
            </div>
            <div class="text-white">
              <h6 class="text-uppercase mb-3">Total CheckedOut</h6>
              <h3 class="mb-0" id="load_customer">{{ $totalCheckedOut }}</h3>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card mini-stat" style="background:#12B4D8 !important">
          <div class="card-body mini-stat-img">
            <div class="mini-stat-icon">
              <i class="mdi mdi-briefcase-check float-right"></i>
            </div>
            <div class="text-white">
              <h6 class="text-uppercase mb-3">Total Reserved</h6>
              <h3 class="mb-0" id="load_expenses">{{ $totalReserved }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end row -->
    <div class="row">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Latest Bookings</h4>
            <div class="table-responsive">
              <table class="table align-middle table-centered table-vertical table-nowrap">
                <thead class="bg-primary">
                  <tr>
                    <td class="text-white">Room</td>
                    <td class="text-white">Checkin</td>
                    <td class="text-white">Checkout</td>
                    <td class="text-white">Amount</td>
                    <td class="text-white">Status</td>
                    <td class="text-white">Customer</td>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($bookings as $booking)
                    <tr>
                      <td>
                        {{ $booking->room->name ?? null }}
                      </td>
                      <td>
                        {{ $booking->checkin }}
                      </td>
                      <td>
                        {{ $booking->checkout }}
                      </td>
                      <td>
                        {{ do_money($booking->amount) }}
                      </td>
                      <td>
                        @if ($booking->status == 1)
                          <span class="badge bg-success px-2">
                            Active
                            <i class="fa fa-spinner fa-spin ms-1" aria-hidden="true"></i>
                          </span>
                        @else
                          <span class="badge bg-danger px-2">Expired</span>
                        @endif
                      </td>
                      <td>{{ $booking->customer->name ?? '' }}</td>
                    <tr>
                    @empty
                    <tr>
                      <td colspan="8">No data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-body">
            <h4 class="card-title mb-4">Reservations</h4>
            <div class="table-responsive">
              <table class="table align-middle table-centered table-vertical table-nowrap">
                <thead class="bg-secondary">
                  <tr>
                    <td class="text-white">Room</td>
                    <td class="text-white">Checkin</td>
                    <td class="text-white">Checkout</td>
                    <td class="text-white">Amount</td>
                    <td class="text-white">Status</td>
                    <td class="text-white">Customer</td>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($reservations as $record)
                    <tr>
                      <td>
                        {{ $record->room->name ?? null }}
                      </td>
                      <td>
                        {{ $record->checkin }}
                      </td>
                      <td>
                        {{ $record->checkout }}
                      </td>
                      <td>
                        {{ do_money($record->amount) }}
                      </td>
                      <td>
                        <span class="badge bg-warning px-2">Reserved</span>
                      </td>
                      <td>{{ $record->customer->name ?? '' }}</td>
                    <tr>
                    @empty
                    <tr>
                      <td colspan="8">No data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Available Rooms</h4>

            <div class="table-responsive">
              <table class="table align-middle table-centered table-vertical table-nowrap mb-1">
                <thead class="bg-primary">
                  <tr>
                    <td class="text-white">Name</td>
                    <td class="text-white">Category</td>
                    <td class="text-white">Price</td>
                    <td class="text-white">Status</td>
                    <td class="text-white">Actions</td>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($rooms as $room)
                    <tr>
                      <td>{{ $room->name }}</td>
                      <td>{{ $room->category->name ?? '' }}</td>
                      <td>{{ do_money($room->price) }}</td>
                      <td>
                        @if ($room->status)
                          <span class="badge rounded-pill bg-success">Active</span>
                        @else
                          <span class="badge rounded-pill bg-danger">Deactive</span>
                        @endif
                      </td>
                      <td>
                        <div class="d-flex">
                          <a href="{{ route('admin.booking.index', $room->uid) }}"
                            class="btn me-2 btn-primary btn-sm waves-effect waves-light"><i class="fa fa-edit"></i>
                            Book Now
                          </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8">No Room Found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- content -->


  <!-- END wrapper -->
@endsection

@push('page-scripts')
  <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
@endpush
