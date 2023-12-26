<form action="{{ route('admin.booking.cancel', $booking->uid) }}" method="post">
  @csrf
  <div class="row">
    <div class="col-md-12">
      <h3>Booking ID: {{ $booking->trx }}</h3>
      <div class="form-group">
        <label for="cancel_reason">Cancel Reason</label>
        <textarea id="cancel_reason" class="form-control" name="cancel_reason" rows="3"></textarea>
      </div>
    </div>
    <div class="col-md-12 mt-5">
      <button class="btn btn-primary" type="submit">Proceed</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </div>
</form>
