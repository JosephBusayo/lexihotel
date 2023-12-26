a<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
    <tr>
      <th>{{ __('#') }}</th>
      <th>{{ __('ID') }}</th>
      <th>{{ __('Cust. Name') }}</th>
      <th>{{ __('Cust. Mobile') }}</th>
      <th>{{ __('Room') }}</th>
      <th>{{ __('Category') }}</th>
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
      @include('admin.bookings._checkout_modal', ['booking' => $booking])

      @php
        
        $checkinDate = Carbon::parse($booking->checkin);
        $checkoutDate = Carbon::parse($booking->checkout);
        $todayDate = Carbon::now();
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
        <td>{{ $booking->room->category->name ?? '' }}</td>
        <td>{{ $booking->checkin }}/{{ $booking->created_at->format('h:i:s a') }}</td>
        <td>{{ $booking->checkout }}</td>
        <td>{{ do_money($booking->amount) }}</td>
        <td>
          @if ($booking->status == 1)
            <span class="badge bg-success px-2">
              Active
              <i class="fa fa-spinner fa-spin ms-1" aria-hidden="true"></i>
            </span>
          @endif

          @if ($booking->status == 3)
            <span class="badge bg-danger px-2">
              Expired
            </span>
          @endif
        </td>
        <td>{{ $booking->duration }}</td>

        {{-- <td>
          @if ($room->status)
            <span class="badge rounded-pill bg-success">Active</span>
          @else
            <span class="badge rounded-pill bg-danger">Deactive</span>
          @endif
        </td> --}}

        <td>
          <div class="d-flex">
            <div class="dropdown mt-3 mt-sm-0">
              <a class="btn btn-secondary dropdown-toggle" href="javascript:void(0);" id="dropdownMenuLink1"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Action
                <i class="mdi mdi-chevron-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" data-popper-placement="top-start">
                @if ($booking->status == 1)
                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#checkoutModal{{ $booking->id }}"
                    data-bs-backdrop="static" href="javascript:void(0)">Checkout Room</a>

                  {{-- <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                    data-bs-target="#extend{{ $booking->uid }}" data-bs-backdrop="static">Extend</a> --}}

                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}"
                    data-bs-backdrop="static" href="javascript:void(0)">Cancel Booking</a>
                @endif

                @php
                  $debt = App\Models\Debt::where('tracking_no', $booking->trx)
                      ->where('cleared', 0)
                      ->first();
                @endphp

                @if ($debt)
                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#debtModal{{ $booking->id }}"
                    data-bs-backdrop="static" href="javascript:void(0)">Pay Debt</a>
                @else
                @endif
                {{-- <a class="dropdown-item" href="javascript:void(0)"></a> --}}
              </div>
            </div>
          </div>
        </td>
      </tr>
      @if ($debt)
        @include('admin.bookings._debt_modal', ['booking' => $booking])
      @endif
      @if ($booking->status == 1)
        @include('admin.bookings._cancel_modal', ['booking' => $booking])
      @endif
      @include('admin.bookings._extend_modal', ['booking' => $booking])
    @empty
      <tr>
        <td colspan="13">No Bookings Found</td>
      </tr>
    @endforelse
  </tbody>
</table>

<div class="d-flex mt-4 justify-content-end">
  <h2 class="text-success">Total Amount: {{ do_money($totalBookingAmount) }}</h2>
</div>
