@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Passed by controller : ['gallery'=>$gallery , 'gallery_image'=>$gallery_image] -->

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
                        <h4 class="page-title" id="ffff"><span style="color:blue">{{ $gallery_name }}</span>&nbsp&nbsp{{ $gallery->ref_display_type }} gallerisi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">İnsert Marka</li>
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
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/index_insert_gallery_image') }}" name="add_gallery_image" id="add_gallery_image" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                    <h4>Yeni görüntü</h4>
                                    <div class="form-group row image-title" style="background-color:white">
                                        <label for="input_image_title" class="col-sm-2 text-left control-label col-form-label">Görüntü başlığı</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form_inputs" name="input_image_title" id="input_image_title" placeholder="Görüntü başlığı" value="{{ old('input_image_title') }}">
                                            <span id="imageTitle_msg" class="error_msg"></span>
                                            @error('input_image_title')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div style="margin-top:5px">
                                                <input id="input_image_file_name" class="form_inputs" type="file" name="input_image_file_name" accept="image/*">
                                                @error('input_image_file_name')
                                                    <div class="error_msg">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="gallery_id" id="gallery_id" value="{{ $gallery->id }}">
                                        <div class="col-md-3">
                                            <input type="submit" id="input_submit_gallery_image" name="input_submit_gallery_image" value="Yeni görüntü ekle" class="btn btn-primary form_inputs" data-action="New">
                                        </div>
                                    </div>    
                            </form>
                    </div>  <!-- "col-md-6"  --> 
                </div> <!-- End row  -->

                <div class="row">
                    <div class="col-md-8">
                        <div id="notice">
                        </div>
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
                        </div>  <!-- "card"  --> 
                    </div>  <!-- "col-md-6"  --> 
                </div> <!-- End row  -->

                <div class="row el-element-overlay">
                @if($gallery_image->count())
                    @foreach($gallery_image as $image)
                    <div class="col-lg-3 col-md-6" id="image_in_gallery_{{ $image->id }}">
                            <div class="card">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> 
                                        <img src="/backend_assets/uploaded_files/images/{{ $image->image_file_name }}" alt=""/>
                                        <div class="el-overlay">
                                            <ul class="list-style-none el-info">
                                                <li class="el-item li_item_image_zoom" id="zoom_{{ $image->id }}" data-image_id="{{ $image->id }}" data-image_action="zoom"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="/backend_assets/uploaded_files/images/{{ $image->image_file_name }}"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                <li class="el-item li_item_image_edit" id="edit_{{ $image->id }}" data-image_id="{{ $image->id }}" data-image_action="edit"><a class="btn default btn-outline el-link edit_href" href="{{ url('admin/edit_row_gallery_image'.$image->id) }}"><i class="fas fa-edit"></i></a></li>
                                                <li class="el-item li_item_image_delete" id="delete_{{ $image->id }}" data-image_id="{{ $image->id }}" data-image_action="delete"><a class="btn default btn-outline el-link delete_href" href="javascript:void(0);"><i class="fas fa-times"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <span class="text-muted">{{ trim($image->image_title) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            @endsection

<!-- My Gallery -->
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <hr class="mt-2 mb-2">
            <div class="row text-center text-lg-left">
            @if($gallery_image->count())
                @foreach($gallery_image as $image)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="/backend_assets/uploaded_files/images/{{ $image->image_file_name }}" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="/backend_assets/uploaded_files/images/{{ $image->image_file_name }}" alt="">
                        <div class="row">
                            <div class="col-sm-12" sty>
                                <div class="image-title text-dark">{{ trim($image->image_title) }}</div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            @endif    
        </div>  
        </div>  
    </div>  
</div>  -->
