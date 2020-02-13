@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
      <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Markalar</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Gösteri Marka</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- End Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Gösteri Marka</h4>
                      <div class="form-group row">
                          <label for="label_marka_name" class="col-sm-3 text-right control-label col-form-label">Marka adı</label>
                          <div class="col-sm-9">
                              <label name="label_marka_name" class="text-right control-label col-form-label">{{ $marka->marka_name }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_marka_slug" class="col-sm-3 text-right control-label col-form-label">Marka slug</label>
                          <div class="col-sm-9">
                              <label name="label_marka_slug" class="text-right control-label col-form-label">{{ $marka->marka_slug }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_marka_description" class="col-sm-3 text-right control-label col-form-label">Marka açıklaması</label>
                          <div class="col-sm-9">
                              <label for="label_marka_description" class="text-right control-label col-form-label">{{ $marka->marka_description }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="image_marka_logo_file" class="col-sm-3 text-right control-label col-form-label">Marka logosu</label>
                        <div class="col-md-9">
                          <div>
                              <img class="rounded responsive modalImage" id="image_marka_logo_file" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $marka->marka_logo_image_name }}" alt="" name="image_marka_logo_file" style="max-width: 100px; max-height: 100px;">
                          </div>  
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <a href="{{ url('marka/') }}" class="btn btn-info" style="padding:3px;">
                            <i class="far fa-share-square" style="color:gold;"></i>
                             Listeye geri dön
                          </a>
                        </div>
                      </div>
                  </div>  <!-- "card bode"  --> 
                </div>  <!-- "card"  --> 
          </div>  <!-- "col-md-6"  --> 
      </div> <!-- End row  -->
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->

  @endsection

