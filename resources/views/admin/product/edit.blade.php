@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-sm-4 col-3">
      <h4 class="page-title">{{ $pageTitle }}</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
      <a href="{{ route('admin.product.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i>
        Go Back</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card-box">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label> Warehouse</label>
              <select id="my-select" class="form-control @error('warehouse') is-invalid @enderror" name="warehouse">
                @foreach ($warehouses as $warehouse)
                  <option value="{{ $warehouse->id }}" @if ($product->warehouse_id == $warehouse->id) selected @endif>
                    {{ $warehouse->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ $product->name }}">
            </div>
            <div class="form-group col-md-6">
              <label>Cost Price</label>
              <input type="text" class="form-control @error('cost_price') is-invalid @enderror" name="cost_price"
                value="{{ $product->cost_price }}">
            </div>
            <div class="form-group col-md-6">
              <label>Selling Price</label>
              <input type="text" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price"
                value="{{ $product->selling_price }}">
            </div>
            <div class="form-group col-md-6">
              <label>Quantity</label>
              <input type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                value="{{ $product->quantity }}">
            </div>
            <div class="form-group col-md-6">
              <label>Status</label>
              <select id="my-select" class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="1" @if ($product->status == 1) selected @endif>Published
                </option>
                <option value="2" @if ($product->status == 0) selected @endif>Pending
                </option>
              </select>
            </div>
          </div>

          <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
