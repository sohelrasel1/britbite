@php
use App\Constants\Constant;
use App\Http\Helpers\Uploader;
@endphp

@extends('user.layout')

@section('content')
<div class="page-header">
  <h4 class="page-title">Logo</h4>
  <ul class="breadcrumbs">
    <li class="nav-home">
      <a href="{{route('user.dashboard')}}">
        <i class="flaticon-home"></i>
      </a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#">Settings</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#">Logo</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Update Logo</div>
      </div>
      <div class="card-body pt-5 pb-4">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="ajaxForm" enctype="multipart/form-data" action="{{route('user.logo.update')}}" method="POST">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-12 mb-2">
                      <label for="image"><strong> Logo **</strong></label>
                    </div>
                    <div class="col-md-12 showImage mb-3">
                      <img src="{{$userBs->logo ? Uploader::getImageUrl(Constant::WEBSITE_LOGO,$userBs->logo,$userBs) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail" width="100">
                    </div>
                    <input type="file" name="logo" id="image" class="form-control">
                    <p id="errlogo" class="mb-0 text-danger em"></p>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <div class="form">
                  <div class="form-group from-show-notify row">
                    <div class="col-12 text-center">
                      <button type="button" id="submitBtn" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection