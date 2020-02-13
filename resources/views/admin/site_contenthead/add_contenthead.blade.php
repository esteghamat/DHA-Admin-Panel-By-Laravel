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
                                    <li class="breadcrumb-item active" aria-current="page">içerik ekle</li>
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
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/add_contenthead') }}" name="add_contenthead" id="add_contenthead" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">İçerik ekle</h4>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">İçerik türü seçin</label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_contenthead_contenttype_id" id="input_contenthead_contenttype_id" style="width: 100%; height:36px;" >
                                              <option value="">Seçin</option>
                                              @foreach ($contenttypes as $contenttype)
                                                <option value="{{ $contenttype->id }}" 
                                                  @if (old('input_contenthead_contenttype_id') == $contenttype->id) 
                                                     selected="selected"
                                                  @endif   
                                                  >
                                                  {{ $contenttype->contenttype_title }}
                                                </option>
                                              @endforeach
                                          </select>
                                          @error('input_contenthead_contenttype_id')
                                            <div class="error_msg">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input_contenthead_title" class="col-sm-3 text-right control-label col-form-label">İçerik başlığı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_contenthead_title" id="input_contenthead_title" placeholder="İçerik başlığı" value="{{ old('input_contenthead_title') }}">
                                            <span id="contentheadTitle_msg" class="error_msg"></span>
                                            @error('input_contenthead_title')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contenthead_slug" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" name="input_contenthead_slug" id="input_contenthead_slug" placeholder="İçerik slug" value="{{ old('input_contenthead_slug') }}">
                                          <span id="contentheadSlug_msg" class="error_msg"></span>
                                          @error('input_contenthead_slug')
                                              <div class="error_msg">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                          <label for="input_contenthead_keywords" class="col-sm-3 text-right control-label col-form-label">Anahtar kelimeler</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_contenthead_keywords" id="input_contenthead_keywords" placeholder="Anahtar kelimeler" value="{{ old('input_contenthead_keywords') }}">
                                              <span id="contentheadKeywords_msg"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contenthead_title_description" class="col-sm-3 text-right control-label col-form-label">Başlık açıklaması</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="input_contenthead_title_description" id="input_contenthead_title_description" placeholder="İş açıklaması" >{{ old('input_contenthead_title_description') }}</textarea>
                                          <span id="contentheadTitleDesc_msg"></span>
                                      </div>
                                    </div>                                    
                                    <div class="form-group row">
                                      <label for="input_contenthead_description" class="col-sm-3 text-right control-label col-form-label">İçerik tam açıklaması</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="input_contenthead_description" id="input_contenthead_description" placeholder="İçerik tam açıklaması" >{{ old('input_contenthead_description') }}</textarea>
                                          <span id="contentheadDesc_msg"></span>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contenthead_image" class="col-sm-3 text-right control-label col-form-label">Ana içerik görüntü</label>
                                      <div class="col-md-9">
                                        <div>
                                            <img class="rounded responsive modalImage preview_image_file" id="contenthead_image_preview" src="{{ asset('backend_assets/assets/images/no_preview.jpg') }}" alt="" name="contenthead_image_preview" style="max-width: 100px; max-height: 100px;">
                                        </div>  
                                        <div style="margin-top:5px">
                                            <input class="input_image_file" id="input_contenthead_image" type="file" name="input_contenthead_image" accept="image/*">
                                            @error('input_contenthead_image')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                            <button type="button" class="transparent_button delete_image_button"
                                                id="input_contentitem_image_delete" name="input_contentitem_image_delete">
                                                <i class="fas fa-undo" style="color:orange; padding:5px"></i>
                                            </button>                                       
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contenthead_logo_image" class="col-sm-3 text-right control-label col-form-label">Ana içerik logo</label>
                                      <div class="col-md-9">
                                        <div>
                                            <img class="rounded responsive modalImage preview_logo_image_file" id="contenthead_logo_image_preview" src="{{ asset('backend_assets/assets/images/no_preview.jpg') }}" alt="" name="contenthead_logo_image_preview" style="max-width: 100px; max-height: 100px;">
                                        </div>  
                                        <div style="margin-top:5px">
                                            <input class="input_logo_image_file" id="input_contenthead_logo_image" type="file" name="input_contenthead_logo_image" accept="image/*">
                                            @error('input_contenthead_logo_image')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                            <button type="button" class="transparent_button delete_logo_image_button"
                                                id="input_contentitem_logo_image_delete" name="input_contentitem_logo_image_delete">
                                                <i class="fas fa-undo" style="color:orange; padding:5px"></i>
                                            </button>
                                        </div>
                                      </div>
                                    </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" value="Yeni içerik ekle" class="btn btn-primary">
                                        <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('contenthead') }}'">İçerik listesi</button>
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

