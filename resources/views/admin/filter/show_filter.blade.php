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
              <h4 class="page-title">Filterler</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Gösteri Filter</li>
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
                      <h4 class="card-title">Gösteri Filter</h4>
                      <div class="form-group row">
                          <label for="label_filter_name" class="col-sm-3 text-right control-label col-form-label">Filter adı</label>
                          <div class="col-sm-9">
                              <label name="label_filter_name" class="text-right control-label col-form-label">{{ $filter->filter_name }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_filter_slug" class="col-sm-3 text-right control-label col-form-label">Filter slug</label>
                          <div class="col-sm-9">
                              <label name="label_filter_slug" class="text-right control-label col-form-label">{{ $filter->filter_slug }}</label>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <a href="{{ url('admin/filter/') }}" class="btn btn-info" style="padding:3px;">
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

