<div class="row">
  <div class="mb-3 col-md-6">
    <label for="name">Name</label>
    <input type="text" value="{{ $room->name }}" class="form-control @error('name') is-invalid @enderror"
      name="name">
  </div>

  <div class="mb-3 col-md-6">
    <label for="building"> {{ __('Building') }}</label>
    <select id="building" class="form-control @error('building') is-invalid @enderror" name="building_id">
      <option value="" selected disabled>{{ __('Select Building') }}</option>
      @foreach ($buildings as $building)
        <option value="{{ $building->id }}"
          @if (isset($room->building_id)) {{ $room->building_id == $building->id ? 'selected' : '' }} @endif>
          {{ $building->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3 col-md-6">
    <label for="floor"> {{ __('Floor') }}</label>
    <select id="floor" class="form-control @error('floor') is-invalid @enderror" name="floor_id">
      <option value="" selected disabled>{{ __('Select Floor') }}</option>
      @foreach ($floors as $floor)
        <option value="{{ $floor->id }}"
          @if (isset($room->floor_id)) {{ $room->floor_id == $floor->id ? 'selected' : '' }} @endif>
          {{ $floor->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3 col-md-6">
    <label for="category"> {{ __('Category') }}</label>
    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category_id">
      <option value="" selected disabled>{{ __('Select Category') }}</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}"
          @if (isset($room->category_id)) {{ $room->category_id == $category->id ? 'selected' : '' }} @endif>
          {{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3 col-md-6">
    <label for="price">Price Per Night</label>
    <input type="price" value="{{ $room->price }}" class="form-control @error('price') is-invalid @enderror"
      name="price" id="price" readonly>
  </div>
  <div class="mb-3 col-md-6">
    <label for="intercom_mobile">Intercom Mobile</label>
    <input type="intercom_mobile" value="{{ $room->intercom_mobile }}"
      class="form-control @error('intercom_mobile') is-invalid @enderror" name="intercom_mobile" id="intercom_mobile">
  </div>

  <div class="mb-4 col-md-12">
    <label for="statuss">Status</label>
    <select id="statuss" class="form-control @error('status') is-invalid @enderror" name="status">
      <option value="1" @if ($room->status) selected @endif>Active</option>
      <option value="2" @if (!$room->status) selected @endif>Deactive</option>
    </select>
  </div>
  {{--  --}}
  <div class="col-md-12 mb-3">
    <div class="row">
      @forelse ($amenities as $amenity)
        <div class="col-md-3">
          <div class="d-flex">
            <input type="checkbox" name="amenities[]" id="switch{{ $amenity->id }}" switch="success"
              @if (in_array($amenity->id, $ids)) checked @endif value="{{ $amenity->id }}" />
            <label for="switch{{ $amenity->id }}" data-on-label="On" data-off-label="Off"></label>
            <p class="ms-2">{{ $amenity->name }}</p>
          </div>
        </div>
      @empty
        <div class="col-md-12">
          No Amenity Availbale
        </div>
      @endforelse
    </div>

  </div>

  <div class="col-md-12 mb-3">
    <label for="description">{{ __('Description (optional)') }}</label>
    <textarea class="form-control" placeholder="Type here" rows="5" name="description"></textarea>
  </div>

  <div class="mb-3 col-md-12 custom-image-upload">
    <div class="left">
      <img id="img-uploaded"
        src="@if (isset($room->image)) {{ getImage($room->image, 'Rooms/') }} @else http://placehold.it/350x350 @endif"
        alt="your image" />
    </div>
    <div class="right">
      <span class="file-wrapper">
        <input type="file" name="image" id="imgInp" class="uploader" />
        <span class="btn btn-sm btn-warning"><i class="fa fa-upload"></i> Upload Image</span>
      </span>
    </div>
    @if (isset($room->image))
      <span class="text-danger">(Leave empty if not changing the image)</span>
    @endif
  </div>
</div>
