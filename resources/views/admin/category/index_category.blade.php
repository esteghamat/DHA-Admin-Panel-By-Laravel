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
                        <h4 class="page-title">Kategory</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kategoryler listesi</li>
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
                        <a href="{{ url('admin/add_category') }}" class="btn btn-success" style="margin-bottom:5px"><span style="font-size:1.3em"><strong> + </strong></span> Yeni kategory ekle</a>
                        <!-- <button style="float: right;margin-bottom:5px" type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('admin/add_category') }}'">Yeni kategory ekle</button> -->
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
                                    <th style="font-weight: bold;padding-left:0.5rem" width="23%">Kategory adı</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="23%">Kategory slug</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="20%">Ana Kategori</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="20%">Açıklaması</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="7%">Göster</th>
                                    <th style="font-weight: bold;padding-left:0.5rem" width="7%">Hareketler</th>
                                </tr>
                                @foreach($data as $row)
                            <tr id="tr_{{$row->id}}">
                                    <td style="vertical-align: middle;padding:5px">{{ $row->category_name }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->category_slug }}</td>
                                    <td style="vertical-align: middle;padding:5px">
                                    <?php
                                      if(isset($row->get_parent->category_name)) 
                                        {
                                          echo($row->get_parent->category_name);
                                        } 
                                        else 
                                        {
                                          echo('--');
                                        }
                                    ?>
                                    </td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->category_description }}</td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center"><a href="{{ url('category/'.$row->category_slug) }}" class="btn btn-primary btn-block btn-sm">Gösteri</a></td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                        <a href="{{ url('admin/edit_row_category'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                                        <!-- <button type="button" class="transparent_button category_delete_button" id="category_delete_button{{$row->id}}" name="category_delete_button{{$row->id}}" data-categoryid="{{$row->id}}" style="padding:3px"><i class="fas fa-times" style="color:red; padding:5px"></i></button> -->
                                        <button type="button" class="transparent_button category_delete_button" 
                                          id="category_delete_button{{$row->id}}" name="category_delete_button{{$row->id}}" 
                                          data-categoryid="{{$row->id}}"
                                          data-modelname="Category" 
                                          data-id="{{$row->id}}" style="padding:3px"
                                          data-title="Kategori sil" 
                                          data-toggle="modal" 
                                          data-target="#confirmDelete" 
                                          >
                                          <i class="fas fa-times" style="color:red; padding:5px"></i>
                                        </button> 
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
