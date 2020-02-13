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
                        <h4 class="page-title">Galeriler</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Galeriler listesi</li>
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
                    <div class="col-md-10">
                        <div class="ml-auto text-right">
                        <!-- <a href="{{ url('admin/add_gallery') }}" class="btn btn-success" style="margin-bottom:5px"><span style="font-size:1.3em"><strong> + </strong></span> Yeni gallery ekle</a> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div id="notice">
                           </div>
                            <!-- --------------------------Flash Message------------------------ -->
                            @if(Session::has('flash_message_error'))
                                <div class="alert alert-error alert-block" style='margin-bottom: 0px'>
                                    <button type="button" id="button_message_error" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('flash_message_error') !!}</strong>
                                </div>
                            @endif    
                            @if(Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block" style='margin-bottom: 0px'>
                                    <button type="button" id="button_message_success" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('flash_message_success') !!}</strong>
                                </div>
                            @endif 
                            <!-- ------------------------End Flash Message---------------------- -->
                            <table class="table table-boardered table striped">
                                <tr class="header_tr">
                                    <th style="font-weight: bold;padding-left:0.5rem" width="30%">Galeri Tipi</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="25%">Galeri görüntüleme türü</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="25%">Galeri görüntü sayımı</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="25%">Görüntülar listesi</th>
                                </tr> 
                                @foreach($data as $row)
                            <tr id="tr_{{$row->id}}">
                                    <td style="vertical-align: middle;padding:5px">{{ $row->ref_type }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->ref_display_type }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->gallery_image_count }}</td>
                                    <td style="vertical-align: middle;padding:5px">
                                        <a href="{{ url('admin/index_insert_gallery_image/'.$row->portfolio->id . '/' .$row->portfolio->portfolio_title. '/' . $row->ref_type . '/' . $row->ref_display_type ) }}" class="btn btn-success" style="padding:3px">Galeri görüntüleri ({{ $row->gallery_image_count  }})</a>
                                        <!-- <a href="{{ url('admin/edit_row_category'.$row->id) }}" class="btn btn-warning" style="padding:3px">Düzenle</a>
                                        <button type="button" class="btn btn-danger category_delete_button" id="category_delete_button{{$row->id}}" name="category_delete_button{{$row->id}}" data-categoryid="{{$row->id}}" style="padding:3px">Kategoryı sil</button> -->
                                    </td>
                                </tr>    
                                @endforeach    
                            </table>
                            {!! $data->links() !!}
                        </div>  <!-- "card"  --> 
                    </div>  <!-- "col-md-6"  --> 
                </div> <!-- End row  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            @endsection
