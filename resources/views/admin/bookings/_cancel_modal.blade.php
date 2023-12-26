<div id="cancelModal{{ $booking->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          Cancel Booking ({{ $booking->trx }})
        </h5>
        <button class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.booking.cancel', $booking->uid) }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cancel_reason">Cancel Reason</label>
                <textarea id="cancel_reason" class="form-control" name="cancel_reason" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-primary" type="submit">Proceed</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>


      </div>
    </div>
  </div>
