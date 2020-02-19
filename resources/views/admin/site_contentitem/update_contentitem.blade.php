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
                        <h4 class="page-title">Site öğeleri içeriği</h4> 
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Öğe içeriğini düzenleme</li>
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
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/update_contentitem') }}" name="update_contentitem" id="update_contentitem" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">Öğeyi düzenleme</h4>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">İçerik türü </label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_contentitem_contenttype_id" id="input_contentitem_contenttype_id" style="width: 100%; height:36px;" disabled>
                                              <option value="">Seçin</option>
                                              @foreach ($contenttypes as $contenttype)
                                                <option value="{{ $contenttype->id }}" 
                                                  @if ($data->site_content_type_id == $contenttype->id) 
                                                     selected="selected"
                                                     <?php $selected_contenttype_slug = $contenttype->contenttype_slug ?>
                                                  @endif   
                                                  >
                                                  {{ $contenttype->contenttype_title }}
                                                </option>
                                              @endforeach
                                          </select>
                                          @error('input_contentitem_contenttype_id')
                                            <div class="error_msg">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input_contentitem_title" class="col-sm-3 text-right control-label col-form-label">İçerik başlığı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_contentitem_title" id="input_contentitem_title" placeholder="İçerik başlığı" value="{{ $data->contentitem_title }}">
                                            <span id="contentitemTitle_msg" class="error_msg"></span>
                                            @error('input_contentitem_title')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contentitem_slug" class="col-sm-3 text-right control-label col-form-label">İçerik slug</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" name="input_contentitem_slug" id="input_contentitem_slug" placeholder="İçerik slug" value="{{ $data->contentitem_slug }}">
                                          <span id="contentitemSlug_msg" class="error_msg"></span>
                                          @error('input_contentitem_slug')
                                              <div class="error_msg">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                          <label for="input_contentitem_keywords" class="col-sm-3 text-right control-label col-form-label">Anahtar kelimeler</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_contentitem_keywords" id="input_contentitem_keywords" placeholder="Anahtar kelimeler" value="{{ $data->contentitem_keywords }}">
                                              <span id="contentitemKeywords_msg"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contentitem_title_description" class="col-sm-3 text-right control-label col-form-label">Kısa Açıklama</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="input_contentitem_title_description" id="input_contentitem_title_description" placeholder="İş açıklaması" >{{ $data->contentitem_title_description }}</textarea>
                                          <span id="contentitemTitleDesc_msg"></span>
                                      </div>
                                    </div>                                    
                                    <div class="form-group row">
                                      <label for="input_contentitem_description" class="col-sm-3 text-right control-label col-form-label">İçerik tam açıklaması</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="input_contentitem_description" id="input_contentitem_description" placeholder="İçerik tam açıklaması" >{{ $data->contentitem_description }}</textarea>
                                          <span id="contentitemDesc_msg"></span>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contentitem_url" class="col-sm-3 text-right control-label col-form-label">URL Adresi</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_contentitem_url" id="input_contentitem_url" placeholder="URL Adresi" value="{{ $data->contentitem_url }}">
                                          <span id="contentitemURL_msg"></span>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_contentitem_image" class="col-sm-3 text-right control-label col-form-label">içerik görüntü</label>
                                      <div class="col-md-9">
                                        <div>
                                            <img class="rounded responsive modalImage preview_image_file" id="contentitem_image_preview" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $data->contentitem_image_name }}" alt="" name="contentitem_image_preview" style="max-width: 100px; max-height: 100px;">
                                        </div>  
                                        <div style="margin-top:5px">
                                            <input class="input_image_file" id="input_contentitem_image" type="file" name="input_contentitem_image" accept="image/*">
                                            @error('input_contentitem_image')
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
                                      <label for="input_contentitem_logo_image" class="col-sm-3 text-right control-label col-form-label">içerik logo</label>
                                      <div class="col-md-9">
                                        <div>
                                            <img class="rounded responsive modalImage preview_logo_image_file" id="contentitem_logo_image_preview" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $data->contentitem_logo_image_name }}" alt="" name="contentitem_logo_image_preview" style="max-width: 100px; max-height: 100px;">
                                        </div>  
                                        <div style="margin-top:5px">
                                            <input class="input_logo_image_file" id="input_contentitem_logo_image" type="file" name="input_contentitem_logo_image" accept="image/*">
                                            @error('input_contentitem_logo_image')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                            <button type="button" class="transparent_button delete_logo_image_button"
                                                id="input_contentitem_logo_image_delete" name="input_contentitem_logo_image_delete">
                                                <i class="fas fa-undo" style="color:orange; padding:5px"></i>
                                            </button>                                       
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">Marka seçin</label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_contentitem_marka_id" id="input_contentitem_marka_id" style="width: 100%; height:36px;">
                                              <option value="">Seçin</option>
                                              @foreach ($markas as $marka)
                                                @if($data->marka_id == $marka->id)
                                                  <option value="{{ $marka->id }}" selected>{{ $marka->marka_name }}</option>
                                                @else                                                      
                                                  <option value="{{ $marka->id }}">{{ $marka->marka_name }}</option>
                                                @endif  
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">Filter seçin</label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_contentitem_filter_id" id="input_contentitem_filter_id" style="width: 100%; height:36px;">
                                              <option value="">Seçin</option>
                                              @foreach ($filters as $filter)
                                                @if($data->filter_id == $filter->id)
                                                  <option value="{{ $filter->id }}" selected>{{ $filter->filter_name }}</option> 
                                                @else                                                      
                                                  <option value="{{ $filter->id }}">{{ $filter->filter_name }}</option>
                                                @endif  
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    <input type="hidden" name="contentitem_id" id="contentitem_id" value="{{ $data->id }}">
                                    <input type="hidden" name="contenttype_id_hidden" id="contenttype_id_hidden" value="{{ $data->site_content_type_id }}">
                                    <input type="hidden" name="contenttype_slug_hidden" id="contenttype_slug_hidden" value="{{ $selected_contenttype_slug }}">
                                    <input class="input_hidden_image_name" type="hidden" name="input_hidden_contentitem_image_name" id="input_hidden_contentitem_image_name" value="{{ $data->contentitem_image_name }}">
                                    <input class="input_hidden_logo_image_name" type="hidden" name="input_hidden_contentitem_logo_image_name" id="input_hidden_contentitem_logo_image_name" value="{{ $data->contentitem_logo_image_name }}">
                                <div class="border-top">
                                    <div class="card-body">
                                        <?php
                                          $url_itemlist = 'contentitem/'.$selected_contenttype_slug;
                                        ?>
                                        <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
                                        <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url($url_itemlist) }}'">İçerik listesi</button>
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

