@extends('layouts.app', ['page' => 'admin.room-management.create-room'])

@push('page-styles')
  <style>
    .custom-image-upload .box {
      background-color: #fff;
      border: 1px solid #ddd;
      display: block;
      max-width: 30em;
      margin: 0 auto;
      border-radius: 4px;
    }

    .custom-image-upload .box header {
      border-bottom: 1px solid #ddd;
      padding: 0.5em 1em;
      margin-bottom: 1em;
    }

    .custom-image-upload .box .content {
      padding: 1em;
    }

    .custom-image-upload .btn,
    button {
      text-align: center;
      display: inline-block;
      vertical-align: middle;
      white-space: nowrap;
      margin: 0.6em 0.6em 0.6em 0;
      padding: 0.35em 0.7em 0.4em;
      text-decoration: none;
      width: auto;
      position: relative;
      border-radius: 4px;
      user-select: none;
      outline: none;
      -webkit-transition: all, 0.25s, ease-in;
      -moz-transition: all, 0.25s, ease-in;
      transition: all, 0.25s, ease-in;
    }

    .custom-image-upload .btn:hover,
    button:hover {
      -webkit-transition: all, 0.25s, ease-in;
      -moz-transition: all, 0.25s, ease-in;
      transition: all, 0.25s, ease-in;
    }

    .custom-image-upload .btn:active,
    button:active {
      box-shadow: 0 !important;
      top: 2px;
      -webkit-transition: background-color, 0.2s, linear;
      -moz-transition: background-color, 0.2s, linear;
      transition: background-color, 0.2s, linear;
      box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    }

    .custom-image-upload input {
      border: 2px solid #eee;
      padding: 1em 0.25em;
      width: 96%;
      color: #999;
      border-radius: 4px;
    }

    .custom-image-upload .left,
    .custom-image-upload .right {
      display: table-cell;
      vertical-align: middle;
    }

    .custom-image-upload .left {
      width: 6em;
      min-width: 6em;
      padding-right: 1em;
    }

    .custom-image-upload .left img {
      width: 100%;
    }

    .custom-image-upload .img-holder {
      display: block;
      vertical-align: middle;
      width: 2em;
      height: 2em;
    }

    .custom-image-upload .img-holder img {
      width: 100%;
      max-width: 100%;
    }

    .custom-image-upload .file-wrapper {
      cursor: pointer;
      display: inline-block;
      overflow: hidden;
      position: relative;
    }

    .custom-image-upload .file-wrapper:hover .btn {
      background-color: #33adff !important;
    }

    .custom-image-upload .file-wrapper input {
      cursor: pointer;
      font-size: 100px;
      height: 100%;
      filter: alpha(opacity=1);
      -moz-opacity: 0.01;
      opacity: 0.01;
      position: absolute;
      right: 0;
      top: 0;
      z-index: 9;
    }
  </style>
@endpush

@section('content')
  @include('partial.breadcrumb')

  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('admin.room.index') }}" class="btn btn-primary waves-effect waves-light">
          <i class="fa fa-chevron-left"></i> Go Back
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-3">Create New Room</h4>
          <form action="{{ route('admin.room.store') }}" method="POST" class="" enctype="multipart/form-data">
            <div class="row">
              @csrf
              @include('admin.rooms-management.rooms._form')
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
@endsection

@push('page-scripts')
  <script>
    var SITE = SITE || {};

    SITE.fileInputs = function() {
      var $this = $(this),
        $val = $this.val(),
        valArray = $val.split('\\'),
        newVal = valArray[valArray.length - 1],
        $button = $this.siblings('.btn'),
        $fakeFile = $this.siblings('.file-holder');
      if (newVal !== '') {
        $button.text('Photo Chosen');
        if ($fakeFile.length === 0) {
          $button.after('<span class="file-holder">' + newVal + '</span>');
        } else {
          $fakeFile.text(newVal);
        }
      }
    };


    $('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var tmppath = URL.createObjectURL(event.target.files[0]);

        reader.onload = function(e) {
          $('#img-uploaded').attr('src', e.target.result);
          $('input.img-path').val(tmppath);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $(".uploader").change(function() {
      readURL(this);
    });

    const category = $('#category');
    const price = $('#price');
    category.on('change', function(e) {
      let value = $(this).val();
      // make ajax request
      $.ajax({
        type: 'POST',
        url: "{{ route('ajax.get-category') }}",
        data: {
          '_token': $("input[name=_token]").val(),
          'category': value,
          type: 'html'
        },
        beforeSend: function() {

        },
        dataType: "html",
        success: function(res) {
          data = JSON.parse(res)
          if (!data.msg) {
            price.val(data.category.price)
            iziToast.success({
              message: "Price has been updated successfully",
              position: "topRight"
            });
          }
          console.log(data);
        }
      });
    })
  </script>
@endpush
