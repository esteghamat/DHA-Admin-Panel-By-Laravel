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
              <h4 class="page-title">İşler</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Gösteri İş</li>
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
                      <h4 class="card-title">Gösteri İşler</h4>
                      <div class="form-group row">
                          <label for="label_marka_name" class="col-sm-3 text-right control-label col-form-label">Marka adı</label>
                          <div class="col-sm-9">
                              <label name="label_marka_name" class="text-right control-label col-form-label">{{ $portfolio->marka->marka_name }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="label_portfolio_title" class="col-sm-3 text-right control-label col-form-label">İş başlığı</label>
                        <div class="col-sm-9">
                            <label name="label_portfolio_title" class="text-right control-label col-form-label">{{ $portfolio->portfolio_title }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_portfolio_slug" class="col-sm-3 text-right control-label col-form-label">Portfolio slug</label>
                          <div class="col-sm-9">
                              <label name="label_portfolio_slug" class="text-right control-label col-form-label">{{ $portfolio->portfolio_slug }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="label_portfolio_keywords" class="col-sm-3 text-right control-label col-form-label">Anahtar Kelimeler</label>
                        <div class="col-sm-9">
                            <label name="label_portfolio_keywords" class="text-right control-label col-form-label">{{ $portfolio->portfolio_keywords }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="label_portfolio_description" class="col-sm-3 text-right control-label col-form-label">Portfolio açıklaması</label>
                          <div class="col-sm-9">
                              <label for="label_portfolio_description" class="text-right control-label col-form-label">{{ $portfolio->portfolio_description }}</label>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="label_portfolio_filter" class="col-sm-3 text-right control-label col-form-label">İş filter</label>
                        <div class="col-sm-9">
                            <label for="label_portfolio_filter" class="text-right control-label col-form-label">{{ $portfolio->filter->filter_name }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="portfolio_image_name" class="col-sm-3 text-right control-label col-form-label">Portfolio logosu</label>
                        <div class="col-md-9">
                          <div>
                              <img class="rounded responsive modalImage" id="portfolio_image_name" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $portfolio->portfolio_image_name }}" alt="" name="portfolio_image_name" style="max-width: 100px; max-height: 100px;">
                          </div>  
                        </div>
                      </div>  
                      <div class="row">
                          <div class="col-sm-12 text-right">
                            <a href="{{ url('portfolio/') }}" class="btn btn-info" style="padding:3px;">
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



