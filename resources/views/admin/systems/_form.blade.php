<div class="row">
  <div class="mb-3 col-md-6">
    <label for="name">Name</label>
    <input type="text" value="{{ $system->name ?? '' }}" class="form-control @error('name') is-invalid @enderror"
      name="name">
  </div>
  <div class="mb-3 col-md-6">
    <label for="mobile">Mobile</label>
    <input type="text" value="{{ $system->mobile ?? '' }}" class="form-control @error('mobile') is-invalid @enderror"
      name="mobile">
  </div>
  <div class="mb-3 col-md-12">
    <label for="checkout_time	">Checkout Time</label>
    <input type="time" value="{{ $system->checkout_time ?? '' }}"
      class="form-control @error('checkout_time	') is-invalid @enderror" name="checkout_time">
  </div>
  <div class="mb-3 col-md-12 custom-image-upload">
    <div class="left">
      <img id="img-uploaded"
        src="@if (isset($system->logo)) {{ asset('Logo/'.$system->logo) }} @else http://placehold.it/140x70 @endif"
        alt="your logo" />
    </div>
    <div class="right">
      <span class="file-wrapper">
        <input type="file" name="image" id="imgInp" class="uploader" />
        <span class="btn btn-sm btn-warning"><i class="fa fa-upload"></i> Upload Logo</span>
      </span>
    </div>
    @if (isset($system->logo))
      <span class="text-danger">(Leave empty if not changing the Logo)</span>
    @endif
  </div>
</div>
