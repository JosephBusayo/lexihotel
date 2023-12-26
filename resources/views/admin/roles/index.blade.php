@extends('layouts.app', ['page' => 'admin.users-management.roles'])

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
        <button type="button" data-bs-toggle="modal" data-bs-target="#addnew"
          class="btn btn-primary waves-effect waves-light">
          <i class="fa fa-plus"></i> Add New
        </button>
        @include('admin.roles._form')
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-3">All Roles</h4>
          @include('admin.roles._table')
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
@endsection

@push('page-scripts')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

  <!-- Datatable init js -->
  <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endpush
