<div class="tabel-responsive">
  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
      <tr>
        <th>{{ __('#') }}</th>
        <th>{{ __('Customer name') }}</th>
        <th>{{ __('Customer Mobile') }}</th>
        <th>{{ __('Customer Address') }}</th>
        <th>{{ __('Date') }}</th>
      </tr>
    </thead>

    <tbody>

      @forelse ($customers as $customer)
        <tr>
          <td class="d-flex align-items-center">
            <span> {{ $loop->index + 1 }}</span>
            <span class="ms-1">
              <input type="checkbox" name="drop" id="{{ $customer->id }}">
            </span>
          </td>
          <td>{{ $customer->name ?? '' }}</td>
          <td>{{ $customer->mobile ?? '' }}</td>
          <td>{{ $customer->address }}</td>
          <td>{{ $customer->created_at->format('Y-m-d h:i:s a') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">No Records Found</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>
