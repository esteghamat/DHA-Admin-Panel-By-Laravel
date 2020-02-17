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
                        <h4 class="page-title">Site ana içerikleri</h4> 
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">içerik</li>
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
                          @if(Session::has('flash_message_error'))
                              {{-- {!! session('flash_message_error') !!} --}}
                              <div class="alert alert-danger alert-block" style='margin-bottom: 0px'>
                                  <button type="button" class="close" data-dismiss="alert">×</button>	
                                      <strong>{!! session('flash_message_error') !!}</strong>
                              </div>
                          @endif    
                          @if(Session::has('flash_message_success'))
                              {{-- {!! session('flash_message_success') !!} --}}
                              <div class="alert alert-success alert-block" style='margin-bottom: 0px'>
                                  <button type="button" class="close" data-dismiss="alert">×</button>	
                                      <strong>{!! session('flash_message_success') !!}</strong>
                              </div>
                          @endif 
                          <div class="card-body">
                              <h4 class="card-title">İçerik ekle</h4>
                              <div class="form-group row">
                                <label for="contenttype_title" class="col-md-3 text-right control-label col-form-label">İçerik türü seçin</label>
                                <div class="col-md-9">
                                    <label class="col-md-3 text-right control-label col-form-label" name="contenttype_title">{{ $contenthead->site_content_type->contenttype_title }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label for="contenthead_title" class="col-sm-3 text-right control-label col-form-label">İçerik başlığı</label>
                                  <div class="col-sm-9">
                                      <label for="contenthead_title" class="col-sm-3 text-right control-label col-form-label">{{ $contenthead->contenthead_title }}</label>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label for="contenthead_slug" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                <div class="col-sm-9">
                                    <label for="contenthead_slug" class="col-sm-3 text-right control-label col-form-label">{{ $contenthead->contenthead_slug }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="contenthead_keywords" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                <div class="col-sm-9">
                                    <label for="contenthead_keywords" class="col-sm-3 text-right control-label col-form-label">{{ $contenthead->contenthead_keywords }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="contenthead_title_description" class="col-sm-3 text-right control-label col-form-label">Başlık açıklaması</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contenthead_title_description" id="contenthead_title_description" placeholder="İş açıklaması" disabled>{{ $contenthead->contenthead_title_description }}</textarea>
                                </div>
                              </div>                                    
                              <div class="form-group row">
                                <label for="contenthead_description" class="col-sm-3 text-right control-label col-form-label">tam açıklaması</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contenthead_description" id="contenthead_title_description" placeholder="İş açıklaması" disabled>{{ $contenthead->contenthead_description }}</textarea>
                                </div>
                              </div>                                    
                              <div class="form-group row">
                                <label for="contenthead_image_name" class="col-sm-3 text-right control-label col-form-label">Ana içerik görüntü</label>
                                <div class="col-md-9">
                                  <div>
                                      <img class="rounded responsive modalImage" id="contenthead_image_name" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contenthead->contenthead_image_name }}" alt="" name="contenthead_image_name" style="max-width: 100px; max-height: 100px;">
                                  </div>  
                                </div>
                              </div>  
                              <div class="form-group row">
                                <label for="contenthead_logo_image_name" class="col-sm-3 text-right control-label col-form-label">Ana içerik logo</label>
                                <div class="col-md-9">
                                  <div>
                                      <img class="rounded responsive modalImage" id="contenthead_logo_image_name" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contenthead->contenthead_logo_image_name }}" alt="" name="contenthead_logo_image_name" style="max-width: 100px; max-height: 100px;">
                                  </div>  
                                </div>
                              </div>  
                              <div class="row">
                              <div class="col-sm-12 text-right">
                                <a href="{{ url('contenthead/') }}" class="btn btn-info" style="padding:3px;">
                                  <i class="far fa-share-square" style="color:gold;"></i>
                                  Listeye geri dön
                                </a>
                              </div>
                          </div>
                        </div>  <!-- "card"  --> 
                    </div>  <!-- "col-md-6"  --> 
                </div> <!-- End row  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            @endsection

