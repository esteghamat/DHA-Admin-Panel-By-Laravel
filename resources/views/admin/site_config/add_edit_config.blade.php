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
            <h4 class="page-title">Ayarlar</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ayar ekle</li>
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
                <form class="form-horizontal" method='POST' action="{{ url('/admin/add_edit_config/'.(isset($config) ? $config->id : '')) }}" name="add_edit_config" id="add_edit_config" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h4 class="card-title">Bir ayar ekleme</h4>
                        <div class="form-group row">
                          <label class="col-md-3 text-right control-label col-form-label">Ayar türü seçin</label>
                          <div class="col-md-9">
                              <select class="select2 form-control custom-select" name="input_configtype_id" id="input_configtype_id" style="width: 100%; height:36px;" >
                                  <option value="">Seçin</option>
                                  @foreach ($configtypes as $configtype)
                                    <option value="{{ $configtype->id }}" 
                                      @if (old('input_configtype_id' , isset($config) ? $config->configtype_id : 0 ) == $configtype->id) 
                                         selected="selected"
                                      @endif   
                                      >
                                      {{ $configtype->configtype_title }}
                                    </option>
                                  @endforeach
                              </select>
                              @error('input_configtype_id')
                                <div class="error_msg">{{ $message }}</div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_config_title" class="col-sm-3 text-right control-label col-form-label">Ayar adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_config_title" id="input_config_title" placeholder="ayar adı" value="{{ old('input_config_title' , isset($config) ? $config->config_title : '' ) }}">
                                <span id="cpnfigTitle_msg" class="error_msg"></span>
                                @error('input_config_title')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="input_config_value" class="col-sm-3 text-right control-label col-form-label">Ayar değeri</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="input_config_value" id="input_config_value" placeholder="ayar değeri" value="{{ old('input_config_value' , isset($config) ? $config->config_value : '' ) }}">
                              <span id="configValue_msg" class="error_msg"></span>
                              @error('input_config_value')
                                  <div class="error_msg">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>  
                      @if(isset($config))     
                        <input type="hidden" name="config_id" id="config_id" value="{{ $config->id }}">
                      @endif  
                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" value="Yeni configtype ekle" class="btn btn-primary">
                            <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('admin/config') }}'">Ayarlar türleri listesi</button>
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
