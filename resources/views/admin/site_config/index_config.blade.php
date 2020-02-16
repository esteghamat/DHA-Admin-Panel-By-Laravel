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
                          <li class="breadcrumb-item active" aria-current="page">Ayarlar listesi</li>
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
              <div class="ml-auto text-right">
              <button style="float: right;margin-bottom:5px" type="button" class="btn btn-info"  onclick="window.location.href = '{{ url('admin/add_edit_config') }}'">
              <i class="fas fa-plus"></i>
              Yeni ayar ekle</button>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
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
                          <th style="font-weight: bold" width="20%">Ayar tipi</th>
                          <th style="font-weight: bold" width="20%">Ayar adı</th>
                          <th style="font-weight: bold" width="20%">Ayar değeri</th>
                          <th style="font-weight: bold;text-align:center" width="10%">Hareketler</th>
                      </tr>
                      @foreach($data as $row)
                      <tr id="tr_{{$row->id}}">
                          <td style="vertical-align: middle;padding:5px">{{ $row->config_type->configtype_title }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->config_title }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->config_value }}</td>
                          <td style="vertical-align: middle;padding:5px;text-align:center">
                              <a href="{{ url('admin/add_edit_config/'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                              <button type="button" class="transparent_button config_delete_button" 
                                      id="config_delete_button{{$row->id}}" name="config_delete_button{{$row->id}}" 
                                      data-modelname="Site_Config" 
                                      data-id="{{$row->id}}" style="padding:3px"
                                      data-title="Ayarı sil" 
                                      data-toggle="modal" 
                                      data-target="#confirmDelete" 
                                      >
                                      <i class="far fa-trash-alt" style="color:red; padding:5px"></i></button> 
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
