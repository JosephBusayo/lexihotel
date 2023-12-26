@extends('layouts.app', ['page' => 'admin.users-management.roles'])

@push('page-styles')
  {{-- <link href="{{ asset('assets/libs/select2/css/select2.min') }}'" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min') }}'" rel="stylesheet">
  <link href="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min') }}'" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min') }}'" rel="stylesheet" /> --}}
@endpush

@section('content')
  @include('partial.breadcrumb')
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('admin.role.index') }}" class="btn btn-primary waves-effect waves-light">
          <i class="fa fa-chevron-left"></i> Go Back
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-3">All Permissions For <strong class="text-danger">{{ inputTitle($role->name) }}</strong>
          </h4>

          <form method="post" action="{{ route('admin.role.permissions-update', $role->id) }}">
            @csrf
            <div class="row">
              @forelse ($permissions as $permission)
                <div class="col-md-3">
                  <div class="d-flex">
                    <input type="checkbox" name="ids[]" id="switch{{ $permission->id }}" switch="success"
                      value="{{ $permission->name }}" @if (in_array($permission->id, $ids)) checked @endif />
                    <label for="switch{{ $permission->id }}" data-on-label="On" data-off-label="Off"></label>
                    <p class="ms-2">{{ $permission->name }}</p>
                  </div>
                </div>
              @empty
                No Permissions Availbale for {{ $role->name }}
              @endforelse
            </div>
            <hr>
            <div class="text-center">
              <button class="btn btn-primary waves-effect waves-light">Update Permissions</button>
            </div>
          </form>


        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
@endsection

@push('page-scripts')
  {{-- <script src="{{ asset('assets/libs/select2/js/select2.min') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min') }}"></script>
  <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min') }}"></script>
  <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min') }}"></script>
  <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
@endpush
