<div class="table-responsive mt-5">
  <h3 class="mb-5 text-center">General Report From {{ $start_date }} to {{ $end_date }} </h3>
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
        {{-- <th class="text-white">{{ __('Date') }}</th> --}}
        <th class="text-white">{{ __('User') }}</th>
        {{-- <th class="text-white">{{ __('Cancel Reason') }}</th> --}}
      </tr>
    </thead>
    <tbody>
      @php
        $cashAmount = 0;
        $posAmount = 0;
        $transferAmount = 0;
        $debtAmount = 0;
        $discountAmount = 0;
      @endphp
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
          <td>{{ getCustomer($booking->customer_id)->name ?? null }}</td>
          <td>{{ getCustomer($booking->customer_id)->mobile ?? null }}</td>

          <td>{{ $booking->checkin }} {{ date('h:i:s a', strtotime($booking->checkin_time)) }}</td>
          <td>{{ $booking->checkout }}
            {{ $booking->checkout_time ? date('h:i:s a', strtotime($booking->checkout_time)) : '' }}</td>
          <td>{{ do_money($booking->amount ?? null) }}</td>
          <td>
            @if ($booking->status == 2)
              <span class="badge rounded-pill bg-success">Reserved</span>
              {{-- @elseif($booking->status == 0)
              <span class="badge rounded-pill bg-success">Active</span> --}}
            @elseif($booking->status == 1)
              <span class="badge rounded-pill bg-success">Active</span>
            @else
              <span class="badge rounded-pill bg-danger">Deactive</span>
            @endif
          </td>
          <td>{{ $booking->duration }}</td>
          {{-- <td>{{ $booking->created_at }}</td> --}}
          <td>{{ getUser($booking->user_id)->username }}</td>

        </tr>
        @php
          
          $cashQuery = App\Models\Payment::where('name', 'cash')
              ->where('trx', $booking->uid)
              ->whereDate('created_at', '>=', $start_date)
              ->whereDate('created_at', '<=', $end_date);
          
          if ($user != 'all') {
              $cashQuery = $cash->where('user_id', $request->user);
          }
          $cashAmount += $cashQuery->sum('amount');
          
          $posQuery = App\Models\Payment::where('name', 'pos')
              ->where('trx', $booking->uid)
              ->whereDate('created_at', '>=', $start_date)
              ->whereDate('created_at', '<=', $end_date);
          if ($user != 'all') {
              $posQuery = $cash->where('user_id', $request->user);
          }
          $posAmount += $posQuery->sum('amount');
          
          $transferQuery = App\Models\Payment::where('name', 'transfer')
              ->where('trx', $booking->uid)
              ->whereDate('created_at', '>=', $start_date)
              ->whereDate('created_at', '<=', $end_date);
          if ($user != 'all') {
              $transferQuery = $transferQuery->where('user_id', $request->user);
          }
          $transferAmount += $transferQuery->sum('amount');
          
          $debtQuery = App\Models\Debt::whereDate('created_at', '>=', $start_date)
              ->whereDate('created_at', '<=', $end_date)
              ->where('tracking_no', $booking->trx);
          if ($user != 'all') {
              $debtQuery = $debt->where('user_id', $user);
          }
          $debtAmount += $debtQuery->sum('amount');
          
          $discountQuery = App\Models\Discount::whereDate('created_at', '>=', $start_date)
              ->whereDate('created_at', '<=', $end_date)
              ->where('tracking_no', $booking->trx);
          if ($user != 'all') {
              $discountQuery = $discount->where('user_id', $user);
          }
          $discountAmount = $discountQuery->sum('amount');
        @endphp
      @empty
        <tr>
          <td colspan="5">No Data</td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>


<div class="d-flex flex-column justify-content-end align-items-end mt-5">

  <h3 class="text-success">Cash: {{ do_money($cashAmount) }}</h3>
  <h3 class="text-success">Pos: {{ do_money($posAmount) }}</h3>
  <h3 class="text-success">Transfer: {{ do_money($transferAmount) }}</h3>
  @if($debtAmount == 0)
    <h3 class="text-success">Debt: {{ do_money($debtAmount) }}</h3>
  @else
    <h3 class="text-success">Debt: {{ do_money($debtAmount - ($cashAmount + $posAmount + $transferAmount)) }}</h3>
  @endif

  <h3 class="text-success">Discount: {{ do_money($discountAmount) }}
  </h3>
  <h3 class="text-success">Total Amount:
    {{ do_money($cashAmount + $posAmount + $transferAmount) }}</h3>

</div>
