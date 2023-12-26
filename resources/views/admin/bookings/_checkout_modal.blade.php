<div id="checkoutModal{{ $booking->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          Checkout Room ({{ $booking->trx }})
        </h5>
        <button class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to carry out this process</p>
        <form action="{{ route('admin.booking.checkout-room', ['uid' => $booking->uid]) }}" method="post">
          @csrf
          <button class="btn btn-primary" type="submit">Proceed</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </form>

      </div>
    </div>
  </div>
