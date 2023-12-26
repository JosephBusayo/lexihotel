<div class="table-responsive mt-5">
  <h3 class="mb-5 text-center">Reservation Report From {{ $start_date }} to {{ $end_date }} </h3>
  <table class="table table-bordered dt-responsive nowrap" id="datatable-buttons"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="bg-primary">
      <tr>
        <th class="text-white">{{ __('#') }}</th>
        <th class="text-white">{{ __('ID') }}</th>
        <th class="text-white">{{ __('Room') }}</th>
        <th class="text-white">{{ __('Category') }}</th>
        <th class="text-white">{{ __('Customer Name') }}</th>
        <th class="text-white">{{ __('Customer Mobile') }}</th>
        <th class="text-white">{{ __('Checkin') }}</th>
        <th class="text-white">{{ __('Checkout') }}</th>
        <th class="text-white">{{ __('Amount') }}</th>
        <th class="text-white">{{ __('Status') }}</th>
        <th class="text-white">{{ __('Days') }}</th>
        <th class="text-white">{{ __('Date') }}</th>
        <th class="text-white">{{ __('User') }}</th>
        {{-- <th class="text-white">{{ __('Cancel Reason') }}</th> --}}
      </tr>
    </thead>
    <tbody>
      @forelse ($bookings as $booking)
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
          </td>
          <td>{{ getRoom($booking->room_id)->name ?? '' }}</td>
          <td>{{ getRoom($booking->room_id)->category->name ?? '' }}</td>
          <td>{{ $booking->customer->name ?? null }}</td>
          <td>{{ $booking->customer->mobile ?? null }}</td>

          <td>{{ $booking->checkin }}</td>
          <td>{{ $booking->checkout }}</td>
          <td>{{ do_money($booking->amount ?? null) }}</td>
          <td>
            @if ($booking->status == 2)
              <span class="badge rounded-pill bg-success">Reserved</span>
            @else
              <span class="badge rounded-pill bg-danger">Deactive</span>
            @endif
          </td>
          <td>{{ $booking->duration }}</td>
          <td>{{ $booking->created_at }}</td>
          <td>{{ getUser($booking->user_id)->username }}</td>

        </tr>
      @empty
        <tr>
          <td colspan="5">No Data</td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>


<div class="d-flex flex-column justify-content-end align-items-end mt-5">
  {{-- <h3 class="text-success">Cash: {{ do_money($cash) }}</h3>
  <h3 class="text-success">Pos: {{ do_money($pos) }}</h3>
  <h3 class="text-success">Transfer: {{ do_money($transfer) }}</h3> --}}
  <h3 class="text-success">Total Amount: {{ do_money($total) }}</h3>
</div>
