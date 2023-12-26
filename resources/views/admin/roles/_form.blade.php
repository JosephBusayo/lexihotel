<div id="addnew" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">Add Role
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.role.store') }}" method="post">
          @csrf
          <div class="mb-3">
            <label for="name" class="col-form-label">{{ _('Role Name') }}</label>
            <input class="form-control" type="text" name="name" value="{{ @old('name') }}" id="name">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
