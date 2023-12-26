<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
    <tr>
      <th>{{ __('#') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Building') }}</th>
      <th>{{ __('Status') }}</th>
      <th>{{ __('Created At') }}</th>
      <th>{{ __('Actions') }}</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($floors as $floor)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $floor->name }}</td>
        <td>{{ $floor->building->name ?? '' }}</td>
        <td>
          @if ($floor->status)
            <span class="badge rounded-pill bg-success">Active</span>
          @else
            <span class="badge rounded-pill bg-danger">Deactive</span>
          @endif
        </td>
        <td>{{ $floor->created_at->format('Y-m-d h:i:s a') }}</td>
        <td>
          <div class="d-flex">
            @can('floor-edit')
              <button type="button" class="btn me-2 btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#update{{ $floor->uid }}"><i class="fa fa-edit"></i>
                Edit</button>
            @endcan
            @can('floor-delete')
              <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#deleteModal{{ $floor->uid }}"><i class="fa fa-trash"></i>Delete</button>
            @endcan
          </div>
          <div id="deleteModal{{ $floor->uid }}" data-bs-backdrop="static" class="modal fade" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title mt-0" id="deleteModal">Delete Floor
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5>Are you sure you want to delete <strong class="text-danger">{{ $floor->name }}</strong></h5>
                  <form action="{{ route('admin.floor.destroy', $floor->uid) }}" method="post" class="mt-3">
                    @csrf
                    <button type="button" class="btn btn-secondary waves-effect"
                      data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Proceed</button>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          @include('admin.rooms-management.floors._update-form', ['floor' => $floor])
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4">No Floor Found</td>
      </tr>
    @endforelse
  </tbody>
</table>
