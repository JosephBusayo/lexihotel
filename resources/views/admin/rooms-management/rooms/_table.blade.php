<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
    <tr>
      <th>{{ __('#') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Building') }}</th>
      <th>{{ __('Floor') }}</th>
      <th>{{ __('Category') }}</th>
      <th>{{ __('Price/Night') }}</th>
      <th>{{ __('Intercom') }}</th>
      <th>{{ __('Status') }}</th>
      <th>{{ __('Created At') }}</th>
      <th>{{ __('Actions') }}</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($rooms as $room)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $room->name }}</td>
        <td>{{ $room->building->name ?? '' }}</td>
        <td>{{ $room->floor->name ?? '' }}</td>
        <td>{{ $room->category->name ?? '' }}</td>
        <td>{{ do_money($room->price) }}</td>
        <td>{{ $room->intercom_mobile }}</td>
        <td>
          @if ($room->status)
            <span class="badge rounded-pill bg-success">Active</span>
          @else
            <span class="badge rounded-pill bg-danger">Deactive</span>
          @endif
        </td>
        <td>{{ $room->created_at->format('Y-m-d h:i:s a') }}</td>
        <td>
          <div class="d-flex">
            @can('room-edit')
              <a href="{{ route('admin.room.edit', $room->uid) }}"
                class="btn me-2 btn-primary btn-sm waves-effect waves-light"><i class="fa fa-edit"></i>
                Edit
              </a>
            @endcan
            @can('room-delete')
              <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#deleteModal{{ $room->uid }}"><i class="fa fa-trash"></i>Delete</button>
            @endcan
          </div>
          <div id="deleteModal{{ $room->uid }}" data-bs-backdrop="static" class="modal fade" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title mt-0" id="deleteModal">Delete Room
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5>Are you sure you want to delete <strong class="text-danger">{{ $room->name }}</strong></h5>
                  <form action="{{ route('admin.user.destroy', $room->uid) }}" method="post" class="mt-3">
                    @csrf
                    <button type="button" class="btn btn-secondary waves-effect"
                      data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Proceed</button>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>

        </td>
      </tr>
    @empty
      <tr>
        <td colspan="8">No Room Found</td>
      </tr>
    @endforelse
  </tbody>
</table>
