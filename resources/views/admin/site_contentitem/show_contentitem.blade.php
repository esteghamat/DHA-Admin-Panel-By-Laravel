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
                        <h4 class="page-title">Site öğeleri içeriği : <span style="font-size:1.0em; color:blue"> {{ $contentitem->site_content_type->contenttype_title }} / {{ $contentitem->contentitem_title }} </span> </h4> 
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">bir içerik öğesini göster</li>
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
                              <h4 class="card-title">bir içerik öğesini göster</h4>
                              <div class="form-group row">
                                <label for="contenttype_title" class="col-md-3 text-right control-label col-form-label">İçerik türü seçin</label>
                                <div class="col-md-9">
                                    <label class="col-md-3 text-right control-label col-form-label" name="contenttype_title">{{ $contentitem->site_content_type->contenttype_title }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label for="contentitem_title" class="col-sm-3 text-right control-label col-form-label">İçerik başlığı</label>
                                  <div class="col-sm-9">
                                      <label for="contentitem_title" class="col-sm-3 text-right control-label col-form-label">{{ $contentitem->contentitem_title }}</label>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label for="contentitem_slug" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                <div class="col-sm-9">
                                    <label for="contentitem_slug" class="col-sm-3 text-right control-label col-form-label">{{ $contentitem->contentitem_slug }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="contentitem_keywords" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                <div class="col-sm-9">
                                    <label for="contentitem_keywords" class="col-sm-3 text-right control-label col-form-label">{{ $contentitem->contentitem_keywords }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="contentitem_title_description" class="col-sm-3 text-right control-label col-form-label">Başlık açıklaması</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contentitem_title_description" id="contentitem_title_description" placeholder="İş açıklaması" disabled>{{ $contentitem->contentitem_title_description }}</textarea>
                                </div>
                              </div>                                    
                              <div class="form-group row">
                                <label for="contentitem_description" class="col-sm-3 text-right control-label col-form-label">tam açıklaması</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contentitem_description" id="contentitem_title_description" placeholder="İş açıklaması" disabled>{{ $contentitem->contentitem_description }}</textarea>
                                </div>
                              </div>                                    
                              <div class="form-group row">
                                <label for="contentitem_image_name" class="col-sm-3 text-right control-label col-form-label">Ana içerik görüntü</label>
                                <div class="col-md-9">
                                  <div>
                                      <img class="rounded responsive modalImage" id="contentitem_image_name" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $contentitem->contentitem_image_name }}" alt="" name="contentitem_image_name" style="max-width: 100px; max-height: 100px;">
                                  </div>  
                                </div>
                              </div>  
                              <div class="form-group row">
                                <label for="contentitem_logo_image_name" class="col-sm-3 text-right control-label col-form-label">Ana içerik logo</label>
                                <div class="col-md-9">
                                  <div>
                                      <img class="rounded responsive modalImage" id="contentitem_logo_image_name" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $contentitem->contentitem_logo_image_name }}" alt="" name="contentitem_logo_image_name" style="max-width: 100px; max-height: 100px;">
                                  </div>  
                                </div>
                              </div>  
                              <div class="form-group row">
                                <label for="label_contentitem_marka_name" class="col-sm-3 text-right control-label col-form-label">Marka adı</label>
                                <div class="col-sm-9">
                                    <label name="label_contentitem_marka_name" class="text-right control-label col-form-label">{{ isset($contentitem->marka->marka_name) ? $contentitem->marka->marka_name : '-' }}</label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="label_contentitem_filter" class="col-sm-3 text-right control-label col-form-label">içerik filter</label>
                                <div class="col-sm-9">
                                    <label for="label_contentitem_filter" class="text-right control-label col-form-label">{{ isset($contentitem->filter->filter_name) ? $contentitem->filter->filter_name : '-' }}</label>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-sm-12 text-right">
                                <a href="{{ url('contentitem/'. $contentitem->site_content_type->contenttype_slug ) }}" class="btn btn-info" style="padding:3px;">
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

