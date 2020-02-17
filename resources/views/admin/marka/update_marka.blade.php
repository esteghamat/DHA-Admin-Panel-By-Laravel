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
                          <li class="breadcrumb-item active" aria-current="page">Düzenle Marka</li>
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
                  <form class="form-horizontal" method='POST' action="{{ url('/admin/update_marka') }}" name="update_marka" id="update_marka" enctype="multipart/form-data" >
                      {{ csrf_field() }}
                      <div class="card-body">
                          <h4 class="card-title">Düzenle Marka</h4>
                          <div class="form-group row">
                              <label for="input_marka_name" class="col-sm-3 text-right control-label col-form-label">Marka adı</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="input_marka_name" id="input_marka_name" placeholder="Marka adı" value="{{ $data->marka_name }}">
                                  <span id="markaName_msg" class="error_msg"></span>
                                  @error('input_marka_name')
                                      <div class="error_msg">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_marka_slug" class="col-sm-3 text-right control-label col-form-label">Marka slug</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="input_marka_slug" id="input_marka_slug" placeholder="Marka slug" value="{{ $data->marka_slug }}">
                                  <span id="markaSlug_msg" class="error_msg"></span>
                                  @error('input_marka_slug')
                                      <div class="error_msg">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="input_marka_keywords" class="col-sm-3 text-right control-label col-form-label">Anahtar kelimeler</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_marka_keywords" id="input_marka_keywords" placeholder="Marka açıklaması"  value="{{ $data->marka_keywords }}">
                                <span id="markaKeywords_msg"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_marka_description" class="col-sm-3 text-right control-label col-form-label">Marka açıklaması</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="input_marka_description" id="input_marka_description" placeholder="Marka açıklaması"  value="{{ $data->marka_description }}">
                                  <span id="markaDesc_msg"></span>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="input_marka_logo_file" class="col-sm-3 text-right control-label col-form-label">Marka logosu yükleme</label>
                            <div class="col-md-9">
                              <div>
                                  <img class="rounded responsive modalImage preview_logo_image_file" id="marka_image_preview" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $data->marka_logo_image_name }}" alt="" name="marka_image_preview" style="max-width: 100px; max-height: 100px;">
                              </div>  
                              <div style="margin-top:5px">
                                  <input class="input_logo_image_file" id="input_marka_logo_file" type="file" name="input_marka_logo_file" accept="image/*" >
                                  @error('input_marka_logo_file')
                                      <div class="error_msg">{{ $message }}</div>
                                  @enderror
                                  <button type="button" class="transparent_button delete_logo_image_button" 
                                      id="input_marka_logo_image_delete" name="input_marka_logo_image_delete">
                                      <i class="fas fa-undo" style="color:orange; padding:5px"></i>
                                  </button>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="marka_id" id="marka_id" value="{{ $data->id }}">
                          <input class="input_hidden_logo_image_name" type="hidden" name="input_hidden_marka_image_name" id="input_marka_image_name" value="{{ $data->marka_logo_image_name }}">
                      <div class="border-top">
                          <div class="card-body">
                              <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
                              <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('marka') }}'">Liste geri dön</button>
                          </div>
                      </div>
                  </form>
              </div>  <!-- "card"  --> 
          </div>  <!-- "col-md-6"  --> 
      </div> <!-- End row  -->
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->

  @endsection

