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
                        <h4 class="page-title">İşlerimiz</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">İşler düzenle</li>
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
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/update_portfolio') }}" name="update_portfolio" id="update_portfolio" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">İşler ekle</h4>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">Marka seçin</label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_portfolio_marka_id" id="input_portfolio_marka_id" style="width: 100%; height:36px;" disabled>
                                              <option value="{{ $data->marka->id }}">{{ $data->marka->marka_name }}</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input_portfolio_title" class="col-sm-3 text-right control-label col-form-label">İş başlığı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_portfolio_title" id="input_portfolio_title" placeholder="İş başlığı" value="{{ $data->portfolio_title }}">
                                            <span id="portfolioTitle_msg" class="error_msg"></span>
                                            @error('input_portfolio_title')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="input_portfolio_slug" class="col-sm-3 text-right control-label col-form-label">İş slug</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" name="input_portfolio_slug" id="input_portfolio_slug" placeholder="İş slug" value="{{ $data->portfolio_slug }}">
                                          <span id="portfolioSlug_msg" class="error_msg"></span>
                                          @error('input_portfolio_slug')
                                              <div class="error_msg">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                          <label for="input_portfolio_keywords" class="col-sm-3 text-right control-label col-form-label">Anahtar kelimeler</label>
                                          <div class="col-sm-9">
                                              <input type="text" class="form-control" name="input_portfolio_keywords" id="input_portfolio_keywords" placeholder="Anahtar kelimeler" value="{{ $data->portfolio_keywords }}">
                                              <span id="portfolioKeyworrds_msg"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input_portfolio_description" class="col-sm-3 text-right control-label col-form-label">İş açıklaması</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="input_portfolio_description" id="input_portfolio_description" placeholder="İş açıklaması">{{ $data->portfolio_description }}</textarea>
                                            <span id="portfolioDesc_msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-md-3 text-right control-label col-form-label">Filter seçin</label>
                                      <div class="col-md-9">
                                          <select class="select2 form-control custom-select" name="input_portfolio_filter_id" id="input_portfolio_filter_id" style="width: 100%; height:36px;">
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
                                    <div class="form-group row">
                                      <label for="input_portfolio_image" class="col-sm-3 text-right control-label col-form-label">Ana işlerimizi görüntü</label>
                                      <div class="col-md-9">
                                        <div>
                                            <img class="rounded responsive modalImage preview_image_file" id="portfolio_image_preview" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $data->portfolio_image_name }}" alt="" name="portfolio_image_preview" style="max-width: 100px; max-height: 100px;">
                                        </div>  
                                        <div style="margin-top:5px">
                                            <input class="input_image_file" id="input_portfolio_image" type="file" name="input_portfolio_image" accept="image/*">
                                            @error('input_portfolio_image')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" name="portfolio_id" id="portfolio_id" value="{{ $data->id }}">
                                    <input type="hidden" name="input_hidden_portfolio_image_name" id="input_portfolio_image_name" value="{{ $data->portfolio_image_name }}">
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
                                        <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('portfolio') }}'">İşlerimşizi listesi</button>
                                        <!-- Delete : onclick event in jquery was handeled. -->
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

