<!-- start page title -->
<div class="row">
  <div class="col-sm-6">
    <div class="page-title-box">
      <h4 class="d-flex"> {{ $pageTitle ?? '' }}
        @if ($pageTitle == 'Front Desk')
          <div class="d-flex align-items-center ms-3">
            <span class="variant"
              style="width: 17px; height: 17px; background-color: #279B0A; display: inline-block; border-radius: 4px; margin-right: 5px"></span>
            <span class="name">Available</span>
          </div>
          <div class="d-flex align-items-center ms-3">
            <span class="variant"
              style="width: 17px; height: 17px; background-color: #E96D3A ; display: inline-block; border-radius: 4px; margin-right: 5px"></span>
            <span class="name">Checked In</span>
          </div>
          <div class="d-flex align-items-center ms-3">
            <span class="variant"
              style="width: 17px; height: 17px; background-color: #DAA520 ; display: inline-block; border-radius: 4px; margin-right: 5px"></span>
            <span class="name">Reserved</span>
          </div>
        @endif

      </h4>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
          <a href="javascript: void(0);">Lexishotel</a>
        </li>
        <li class="breadcrumb-item active">
          {{ $pageTitle ?? '' }}
        </li>

      </ol>
    </div>
  </div>
  <div class="col-sm-6">

  </div>
</div>
<!-- end page title -->
