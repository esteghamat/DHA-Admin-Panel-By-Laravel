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
                        <h4 class="page-title">Yönetici Ayarları</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Gösterge Paneli</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Yönetici Parolasını Değiştir</li>
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
                                <div class="alert alert-error alert-block" style='margin-bottom: 0px'>
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
                            <form class="form-horizontal" method='POST' action="{{ url('/admin/update_password') }}" name="password_validate" id="password_validate" >
                               {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">Şifre değiştir</h4>
                                    <div class="form-group row">
                                        <label for="current_pwd" class="col-sm-3 text-right control-label col-form-label">Şimdiki Şifre</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="Current password here">
                                            <span id="chkPwd"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_pwd" class="col-sm-3 text-right control-label col-form-label">Yeni Şifre</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="New password here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_pwd" class="col-sm-3 text-right control-label col-form-label">Şifreyi Onayla</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="New password again">
                                        </div>
                                    </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" value="Şifre güncelle" class="btn btn-success">
                                        <span id="confPwd"></span>
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
