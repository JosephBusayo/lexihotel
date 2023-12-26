@extends('layouts.app', ['page' => 'admin.end-business.index'])

@section('content')
  @include('partial.breadcrumb')

  <div class="row">
    <div class="col-12">
      <div class="card m-b-20">
        <div class="card-header">
          End Business Day
        </div>
        <div class="card-body">

          <div class="widget-content widget-content-area">
            <h3 class="box-title">Current Date ({{ date('D j F Y', strtotime(businessDay()->current_date)) }})

            </h3>
            <h3 class="box-title">
              Next Capture Date Will be ({{ date('D j F Y') }})
            </h3>
            <span class="text-danger d-flex">Note: Please always end your business day after 12:00am </span>
            <br class="mt-3">
            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
              data-bs-target="#endBusiness">End Business Day</button>

          </div>

        </div>
      </div>
    </div> <!-- end col -->
  </div> <!-- end row -->

  <div id="endBusiness" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="endBusiness"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mt-0" id="deleteModal">End Business Day
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5>Are you sure you want to end current business day <br>
            <strong class="text-danger">{{ date('D j F Y', strtotime(businessDay()->current_date)) }}</strong>
          </h5>
          <form action="{{ route('admin.end-business.index') }}" method="post" class="mt-3">
            @csrf
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">Proceed</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- END wrapper -->
@endsection
