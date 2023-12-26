<div id="update{{ $building->uid }}" data-bs-backdrop="static" class="modal fade" tabindex="-1"
  aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">Update Building: ({{ $building->name }})
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.building.update', $building->uid) }}" method="post">
          @csrf
          <div class="mb-3">
            <label for="name" class="col-form-label">{{ _('Building Name') }}</label>
            <input class="form-control" type="text" name="name" value="{{ $building->name }}" id="name">
          </div>
          <div class="mb-3">
            <label class="col-form-label">{{ __('Status') }}</label>
            <select class="form-control" name="status">
              <option value="" selected disabled>{{ __('Select a Status') }}</option>
              <option @if ($building->status) selected @endif value="active">Active</option>
              <option @if (!$building->status) selected @endif value="deactive">Deactive</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
