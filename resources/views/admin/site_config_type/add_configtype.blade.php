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
            <h4 class="page-title">Ayar türleri</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ayar türü ekle</li>
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
                <form class="form-horizontal" method='POST' action="{{ url('/admin/add_configtype') }}" name="add_configtype" id="add_configtype" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h4 class="card-title">Ayar türü ekle</h4>
                        <div class="form-group row">
                            <label for="input_configtype_title" class="col-sm-3 text-right control-label col-form-label">ayar türü adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_configtype_title" id="input_configtype_title" placeholder="ayar türü adı" value="{{ old('input_configtype_title') }}">
                                <span id="contenttypeName_msg" class="error_msg"></span>
                                @error('input_configtype_title')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" value="Yeni configtype ekle" class="btn btn-primary">
                            <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('admin/contenttype') }}'">Ayarlar türleri listesi</button>
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
