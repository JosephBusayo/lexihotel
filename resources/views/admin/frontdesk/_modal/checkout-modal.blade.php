<p>Are you sure you want to carry out this process</p>
<form action="{{ route('admin.booking.checkout-room', ['uid' => $booking->uid]) }}" method="post">
  @csrf
  <button class="btn btn-primary" type="submit">Proceed</button>
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</form>
