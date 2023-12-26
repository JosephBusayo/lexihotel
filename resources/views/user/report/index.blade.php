@extends('layouts.user')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card-box bg-white">
        <div class="card-block">
          <h4 class="text-success">Warehouse: {{ $user->warehouse->name }}</h4>
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
                  <th>Staff Name</th>
                  <th>Staff ID</th>
                  <th>Product</th>
                  <th>Selling price</th>
                  <th>quantity</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                @if (count($transactions) > 0)
                  @foreach ($transactions as $transaction)
                    <tr>
                      <td>{{ $transaction->staff_name }}</td>
                      <td>{{ $transaction->staff_id }}</td>
                      <td>{{ $transaction->product->name }}</td>
                      <td>{{ number_format($transaction->product->selling_price, 2) }}</td>
                      <td>{{ $transaction->product->quantity }}</td>
                      <td>{{ number_format($transaction->amount, 2) }}</td>

                      <td>{{ $transaction->created_at->format('Y-m-d') }}</td>

                      <td>{{ $transaction->created_at->format('h:i:s a') }}</td>
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
