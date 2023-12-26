@extends('layouts.app', ['page' => 'admin.customers.index'])

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
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Customers lists
        </div>
        <div class="card-body">
          @include('admin.customers._table')
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->

  <!-- END wrapper -->
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

  <script>
    $(function() {
      $('.checkout-room').on('click', function() {
        // make ajax request
        let uid = $(this).attr('data-id');
        console.log(uid);
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.booking.ajax.checkout-room') }}",
          data: {
            '_token': $("input[name=_token]").val(),
            'uid': uid,
            type: 'html'
          },
          beforeSend: function() {
            checkoutBtn.attr('disabled', true)
          },
          dataType: "html",
          success: function(res) {
            checkoutBtn.attr('disabled', true)
            data = JSON.parse(res)
            if (data.msg == "notdue") {
              iziToast.warning({
                message: "Rooms not overdue",
                position: "topRight"
              });
            } else if (data.msg == "debt") {
              iziToast.warning({
                message: "This transaction has a pending debt to be settled",
                position: "topRight"
              });
            } else {
              iziToast.success({
                message: "Rooms checkout successfully",
                position: "topRight"
              });
            }
            // $('#result').html(output);
            // console.log(res);
          }
        });
      })

      const cancelBtn = $('#cancel');
      cancelBtn.on('click', function() {
        // make ajax request
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.booking.ajax.cancel-room') }}",
          data: {
            '_token': $("input[name=_token]").val(),
            'uid': $(this).attr('data-id'),
            type: 'html'
          },
          beforeSend: function() {
            cancelBtn.attr('disabled', true)
          },
          dataType: "html",
          success: function(res) {
            cancelBtn.attr('disabled', true)
            data = JSON.parse(res)
            if (data.msg == "unavailable") {
              iziToast.warning({
                message: "",
                position: "topRight"
              });
            } else if (data.msg == "success") {
              iziToast.success({
                message: "Rooms cancel successfully",
                position: "topRight"
              });
            }
            // $('#result').html(output);
            console.log(res);
          }
        });
      })


    })
  </script>
@endpush
