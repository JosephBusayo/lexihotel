@extends('layouts.app', ['page' => 'admin.reports.reserve'])

@push('page-styles')
  <!-- DataTables -->
  <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
  @include('partial.breadcrumb')
  {{-- form --}}
  <div class="card" style="min-height: 20rem">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group mb-3">
            <label for="start_date">Users</label>
            <select name="user" id="user" class="form-select">
              <option value="">--Select User--</option>
              <option value="all">All</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group mb-3">
            <label for="start_date">Start Date</label>
            <div class="input-group" id="datepicker2">
              <input type="text" class="form-control report-datepicker" placeholder="yyyy-mm-dd"
                data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' id="start_date" name="start_date">
              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
            </div><!-- input-group -->
            {{-- <input id="start_date" class="form-control" type="text" name=""> --}}
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group mb-3">
            <label for="end_date">End Date</label>
            {{-- <input id="end_date" class="form-control" type="text" name=""> --}}
            <div class="input-group" id="datepicker2">
              <input type="text" class="form-control report-datepicker" placeholder="yyyy-mm-dd"
                data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' id="end_date" name="end_date">
              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
            </div><!-- input-group -->

          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" id="search_btn" type="button">Search Report</button>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <div id="result"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-scripts')
  <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
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
  <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
  <!-- Datatable init js -->
  <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

  <script>
    $(function() {
      const searchBtn = $("#search_btn");
      searchBtn.on('click', function(e) {
        e.preventDefault();
        let user = $("#user");
        let startDate = $("#start_date");
        let endDate = $("#end_date");
        if (user.val() == "" || startDate.val() == "" || endDate.val() == "") {
          iziToast.error({
            message: "All fields required",
            position: "topRight"
          });
        } else {
          $.ajax({
            type: 'POST',
            url: "{{ route('ajax.report.get-reservation') }}",
            data: {
              '_token': $("input[name=_token]").val(),
              type: 'html',
              user: user.val(),
              start_date: startDate.val(),
              end_date: endDate.val()
            },
            beforeSend: function() {
              searchBtn.attr('disabled', true);
            },
            dataType: "html",
            success: function(res) {
              searchBtn.attr('disabled', false);
              $("#result").html(res)
              $(document).find("#datatable-buttons")
                .DataTable({
                  lengthChange: !1,
                  buttons: ["copy", "excel", "pdf", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
                $(".dataTables_length select").addClass("form-select form-select-sm");
            }
          })

        }
      })

    })
  </script>
@endpush
