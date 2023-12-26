@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-sm-4 col-3">
      <h4 class="page-title">{{ $pageTitle }}</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
      <a href="{{ route('admin.product.create') }}" class="btn btn-primary float-right btn-rounded"><i
          class="fa fa-plus"></i>
        Add Product</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box bg-white">
        <div class="card-block">
          <h6 class="card-title text-bold">{{ $pageTitle }}</h6>

          <div class="table-responsive">
            <table class="datatable table table-stripped ">
              <thead class="bg-secondary">
                <tr>
                  <th>Name</th>
                  <th>Warehouse</th>
                  <th>Cost price</th>
                  <th>Selling price</th>
                  <th>quantity</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if (count($products) > 0)
                  @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->warehouse->name ?? '' }}</td>
                      <td>{{ number_format($product->cost_price, 2) }}</td>
                      <td>{{ number_format($product->selling_price, 2) }}</td>
                      <td>{{ $product->quantity }}</td>
                      <td>
                        @if ($product->status == 1)
                          <span class="badge badge-pill badge-success">Published</span>
                        @else
                          <span class="badge badge-pill badge-danger">Pending</span>
                        @endif

                      </td>
                      <td>{{ $product->created_at->format('Y-m-d') }}</td>
                      <td>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                          data-target="#deletemodal{{ $product->id }}">Delete</a>
                      </td>
                      <div id="deletemodal{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="my-modal-title">Delete Product: {{ $product->name }}</h5>
                              <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you want to delete <strong
                                  class="text-danger">{{ $product->name }}</strong>
                              </p>

                              <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Proceed</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5">no data yet</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-script')
@endpush
