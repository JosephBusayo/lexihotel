@extends('layouts.app', ['page' => 'admin.reports.reserve'])

@push('page-styles')
  @push('page-styles')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
      type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
      type="text/css" />
  @endpush
@endpush

@section('content')
  @include('partial.breadcrumb')
  {{-- form --}}
  <div class="card">
    <div class="card-body">
      {{-- <div class="row">
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
            <input id="start_date" class="form-control" type="text" name="">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group mb-3">
            <label for="end_date">End Date</label>
            <input id="end_date" class="form-control" type="text" name="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" id="search_btn" type="button">Search Report</button>
          </div>
        </div>

      </div> --}}

      <div class="row">
        <div class="col-md-12">
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="bg-primary">
              <tr>
                <th class="text-white">{{ __('#') }}</th>
                <th class="text-white">{{ __('Name') }}</th>
                <th class="text-white">{{ __('Building') }}</th>
                <th class="text-white">{{ __('Floor') }}</th>
                <th class="text-white">{{ __('Category') }}</th>
                <th class="text-white">{{ __('Price/Night') }}</th>
                <th class="text-white">{{ __('Intercom') }}</th>
                <th class="text-white">{{ __('Status') }}</th>
                <th class="text-white">{{ __('Created At') }}</th>
                <th class="text-white">{{ __('Actions') }}</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($rooms as $room)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $room->name }}</td>
                  <td>{{ $room->building->name ?? '' }}</td>
                  <td>{{ $room->floor->name ?? '' }}</td>
                  <td>{{ $room->category->name ?? '' }}</td>
                  <td>{{ do_money($room->price) }}</td>
                  <td>{{ $room->intercom_mobile }}</td>
                  <td>
                    @if ($room->status)
                      <span class="badge rounded-pill bg-success">Active</span>
                    @else
                      <span class="badge rounded-pill bg-danger">Deactive</span>
                    @endif
                  </td>
                  <td>{{ $room->created_at->format('Y-m-d h:i:s a') }}</td>
                  <td>
                    <div class="d-flex">
                      <a href="{{ route('admin.room.edit', $room->uid) }}"
                        class="btn me-2 btn-primary btn-sm waves-effect waves-light"><i class="fa fa-edit"></i>
                        Edit
                      </a>
                      <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $room->uid }}"><i class="fa fa-trash"></i>Delete</button>
                    </div>
                    <div id="deleteModal{{ $room->uid }}" data-bs-backdrop="static" class="modal fade" tabindex="-1"
                      aria-labelledby="deleteModal" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title mt-0" id="deleteModal">Delete Room
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <h5>Are you sure you want to delete <strong class="text-danger">{{ $room->name }}</strong>
                            </h5>
                            <form action="{{ route('admin.user.destroy', $room->uid) }}" method="post" class="mt-3">
                              @csrf
                              <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger waves-effect waves-light">Proceed</button>
                            </form>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8">No Room Found</td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div class="d-flex mt-4 px-3 justify-content-end align-items-center">
            <h2 class="text-success">Total Available: {{ $rooms->count() }}</h2>
          </div>
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
            }
          })

        }
      })

    })
  </script>
@endpush
