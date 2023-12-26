<div class="row">
  <div class="mb-3 col-md-6">
    <label for="name">Name</label>
    <input type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror"
      name="name">
  </div>
  {{-- <div class="mb-3 col-md-6">
    <label for="email">Email Address</label>
    <input type="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror"
      name="email">
  </div> --}}

  <div class="mb-3 col-md-6">
    <label for="username">Username</label>
    <input type="text" value="{{ $user->username }}" class="form-control @error('username') is-invalid @enderror"
      name="username">
  </div>

  <div class="mb-3 col-md-6">
    <label for="role"> {{ __('Role') }}</label>
    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
      @foreach ($roles as $role)
        <option value="{{ $role->name }}"
          @if (isset($user->getRoleNames()[0])) {{ $user->getRoleNames()[0] == $role->name ? 'selected' : '' }} @endif>
          {{ $role->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3 col-md-6">
    <label>Password @if (isset($user->password))
        <span class="text-danger">(Leave empty if not changing the password)</span>
      @endif
    </label>
    <input type="text" class="form-control @error('password') is-invalid @enderror" name="password">
  </div>

  <div class="mb-3 col-md-6">
    <label>Status</label>
    <select id="my-select" class="form-control @error('status') is-invalid @enderror" name="status">

      <option value="1" @if ($user->status) selected @endif>Active</option>
      <option value="2" @if (!$user->status) selected @endif>Deactive</option>
    </select>
  </div>
  <div class="mb-3 col-md-12 custom-image-upload">
    <div class="left">
      <img id="img-uploaded"
        src="@if (isset($user->image)) {{ getImage($user->image) }} @else http://placehold.it/350x350 @endif"
        alt="your image" />
    </div>
    <div class="right">
      <span class="file-wrapper">
        <input type="file" name="image" id="imgInp" class="uploader" />
        <span class="btn btn-sm btn-warning"><i class="fa fa-upload"></i> Upload Image</span>
      </span>
    </div>
    @if (isset($user->image))
      <span class="text-danger">(Leave empty if not changing the image)</span>
    @endif
  </div>
</div>
