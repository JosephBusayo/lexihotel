<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
    <tr>
      <th>{{ __('#') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Permissions') }}</th>
      <th>{{ __('Created At') }}</th>
      <th>{{ __('Actions') }}</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($roles as $role)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $role->name }}</td>
        <td>
          <a href="{{ route('admin.role.permission', $role->id) }}" class="btn btn-info btn-sm waves-effect waves-light">
            <i class="fa fa-edit me-1"></i>Manage
          </a>
        </td>
        <td>{{ $role->created_at->format('Y-m-d h:i:s a') }}</td>
        <td>
          <div class="d-flex">
            <button type="button" class="btn me-2 btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal"
              data-bs-target="#update{{ $role->id }}"><i class="fa fa-edit"></i>
              Edit</button>
            <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal"
              data-bs-target="#deleteModal{{ $role->id }}"><i class="fa fa-trash"></i>Delete</button>
          </div>
          <div id="deleteModal{{ $role->id }}" data-bs-backdrop="static" class="modal fade" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title mt-0" id="deleteModal">Delete Role
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5>Are you sure you want to delete <strong class="text-danger">{{ $role->name }}</strong></h5>
                  <form action="{{ route('admin.role.destroy', $role->id) }}" method="post" class="mt-3">
                    @csrf
                    <button type="button" class="btn btn-secondary waves-effect"
                      data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Proceed</button>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          @include('admin.roles._update-form', ['role' => $role])
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4">No Role Found</td>
      </tr>
    @endforelse
  </tbody>
</table>
