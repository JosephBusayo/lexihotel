<div class="table-responsive mt-5">
  <h3 class="mb-5 text-center">Discount Report From {{ $start_date }} to {{ $end_date }} </h3>
  <table class="table table-bordered dt-responsive nowrap" id="datatable-buttons"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="bg-primary">
      <tr>
        <th class="text-white">#</th>
        <th class="text-white">Tracking Code</th>
        <th class="text-white">Amount</th>
        <th class="text-white">Customer</th>
        <th class="text-white">Approved</th>
        <th class="text-white">Date</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($discounts as $discount)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $discount->tracking_no }}</td>
          <td>{{ do_money($discount->amount) }}</td>
          <td>{{ $discount->customer->name ?? null }}</td>
          <td>Admin</td>
          <td>{{ $discount->created_at->format('Y-m-d h:i:s a') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">No Data</td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>


<div class="d-flex justify-content-end mt-5">
  <h3 class="text-success">Discounted Amount: {{ do_money($total) }}</h3>
</div>
