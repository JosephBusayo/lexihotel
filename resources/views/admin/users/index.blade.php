@extends('layouts.app', ['page' => 'admin.users-management.users'])

@push('page-styles')
  <!-- DataTables -->
  <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
@endpush

@section('content')
  @include('partial.breadcrumb')
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary waves-effect waves-light">
          <i class="fa fa-plus"></i> Add New
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-3">All Users</h4>
          @include('admin.users._table')
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
@endsection

@push('page-scripts')
@endpush
