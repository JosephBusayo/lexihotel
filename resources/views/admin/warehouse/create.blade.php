@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-sm-4 col-3">
      <h4 class="page-title">{{ $pageTitle }}</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
      <a href="{{ route('admin.warehouse.index') }}" class="btn btn-primary float-right btn-rounded"><i
          class="fa fa-plus"></i> Go Back</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card-box">
        <form action="{{ route('admin.warehouse.create') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>State</label>
            <select id="my-select" class="form-control @error('state') is-invalid @enderror" name="state">
              @foreach ($states as $state)
                <option value="{{ $state->state_id }}">{{ $state->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select id="my-select" class="form-control @error('status') is-invalid @enderror" name="status">
              <option value="1">activate</option>
              <option value="2">De-activate</option>
            </select>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
