@extends('layouts.user')

@section('content')
  <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
      <div class="dash-widget">
        <div class="row no-gutters">
          <div class="col-5">
            <div class="circle1"></div>
          </div>
          <div class="col-7">
            <div class="dash-widget-info text-right">
              <h3>{{ $user->warehouse->name ?? '' }}</h3>
              <span class="widget-title1">Warehouse</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
      <div class="dash-widget">
        <div class="row no-gutters">
          <div class="col-5">
            <div class="circle2"></div>
          </div>
          <div class="col-7">
            <div class="dash-widget-info text-right">
              <h3>{{ $productCount }}</h3>
              <span class="widget-title2">Total Product</span>
            </div>
          </div>
        </div>
      </div>
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
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                          data-target="#deletemodal{{ $product->id }}">Dispatch</a>
                      </td>
                      <div id="deletemodal{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="my-modal-title">Dispatch Product: {{ $product->name }}</h5>
                              <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <strong class="text-success">Current Quantity: {{ $product->quantity }}</strong>
                              <br>
                              <form action="{{ route('user.product.dispatchProduct', $product->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                  <label for="quantity">Quantity</label>
                                  <input id="quantity" class="form-control" type="number" name="quantity">
                                </div>

                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input id="name" class="form-control" type="text" name="name">
                                </div>

                                <div class="form-group">
                                  <label for="staff_id">staff ID</label>
                                  <input id="staff_id" class="form-control" type="text" name="staff_id">
                                </div>
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
