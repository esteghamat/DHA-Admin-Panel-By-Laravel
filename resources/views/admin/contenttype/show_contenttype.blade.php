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
              <h4 class="page-title">İçerik türleri</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Gösteri İçerik türleri</li>
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
                      <h4 class="card-title">Gösteri İçerik türü</h4>
                      <div class="form-group row">
                          <label for="label_contenttype_title" class="col-sm-3 text-right control-label col-form-label">İçerik türü adı</label>
                          <div class="col-sm-9">
                              <label name="label_contenttype_title" class="text-right control-label col-form-label">{{ $contenttype->contenttype_title }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_contenttype_slug" class="col-sm-3 text-right control-label col-form-label">İçerik türü slug</label>
                          <div class="col-sm-9">
                              <label name="label_contenttype_slug" class="text-right control-label col-form-label">{{ $contenttype->contenttype_slug }}</label>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <a href="{{ url('admin/contenttype/') }}" class="btn btn-info" style="padding:3px;">
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

