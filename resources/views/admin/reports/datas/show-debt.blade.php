<div class="table-responsive mt-5">
  <h3 class="mb-5 text-center">Debt Report From {{ $start_date }} to {{ $end_date }} </h3>
  <table class="table table-bordered dt-responsive nowrap" id="datatable-buttons"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="bg-primary">
      <tr>
        <th class="text-white">#</th>
        <th class="text-white">Tracking Code</th>
        <th class="text-white">Amount</th>
        <th class="text-white">Amount Paid</th>
        <th class="text-white">Amount Oweing</th>
        <th class="text-white">Given By</th>
        <th class="text-white">Customer</th>
        <th class="text-white">Customer No.</th>
        <th class="text-white">Cleared</th>
        <th class="text-white">Cleared By</th>
        <th class="text-white">Date Cleared</th>
        <th class="text-white">Date Created</th>
      </tr>
    </thead>
    <tbody>
      @php
        $amountOweing = 0;
      @endphp
      @forelse ($debts as $debt)
        <tr>
          <td class="d-flex align-items-center">
            <span> {{ $loop->index + 1 }}</span>

            <span class="ms-1">
              <input type="checkbox" name="drop" id="{{ $debt->id }}">
            </span>
          </td>
          <td>{{ $debt->tracking_no }}
          </td>
          <td>{{ do_money($debt->amount) }}</td>
          <td>{{ do_money($debt->amount_paid) }}</td>
          <td>{{ do_money($debt->amount - $debt->amount_paid) }}</td>
          <td>{{ $debt->user->username ?? null }}</td>
          <td>{{ $debt->customer->name ?? null }}</td>
          <td>{{ $debt->customer->mobile ?? null }}</td>

          <td>
            @if ($debt->cleared)
              <span class="badge bg-success px-2">Cleared</span>
            @else
              <span class="badge bg-danger px-2">Oweing</span>
            @endif
          </td>
          <td>{{ getUser($debt->cleared_by)->username ?? null }}</td>
          <td>{{ $debt->date_cleared }}</td>
          <td>{{ $debt->created_at->format('Y-m-d h:i:s a') }}</td>
        </tr>
        @php
          $amountOweing += $debt->amount - $debt->amount_paid;
        @endphp
      @empty
        <tr>
          <td colspan="10">No Data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>


<div class="d-flex justify-content-end mt-5">
  <h3 class="text-success">Amount Oweing: {{ do_money($amountOweing) }}</h3>
</div>
