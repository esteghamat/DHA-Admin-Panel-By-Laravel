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
                        <h4 class="page-title">Görüntüler galerisi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Düzenle görüntü</li>
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
                                <div class="alert alert-danger alert-block" style='margin-bottom: 0px'>
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('flash_message_error') !!}</strong>
                                </div>
                            @endif    
                            @if(Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block" style='margin-bottom: 0px'>
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('flash_message_success') !!}</strong>
                                </div>
                            @endif 
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/update_gallery_image') }}" name="update_gallery_image" id="update_gallery_image" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">Görüntü başlığını düzenle</h4>
                                    <div class="form-group row">
                                        <label for="input_image_title" class="col-sm-3 text-right control-label col-form-label">Görüntü başlığı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_image_title" id="input_image_title" placeholder="görüntü başlığı" value="{{ $data->image_title }}">
                                            <span id="imageTitle_msg" class="error_msg"></span>
                                            @error('input_image_title')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="referrer_gallery_address" id="referrer_gallery_address" value="{{ Request::server('HTTP_REFERER') }}">
                                    <input type="hidden" name="image_id" id="image_id" value="{{ $data->id }}">
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
                                        <button type="button" class="btn btn-success"  onClick="window.history.back()">Liste geri dön</button>
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

