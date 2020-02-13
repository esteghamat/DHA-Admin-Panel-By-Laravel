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
              <h4 class="page-title">İçerik türleri</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">İçerik türleri listesi</li>
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
              <button style="float: right;margin-bottom:5px" type="button" class="btn btn-info"  onclick="window.location.href = '{{ url('admin/add_contenttype') }}'">
              <i class="fas fa-plus"></i>
              Yeni contenttype ekle</button>
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
                          <th style="font-weight: bold" width="20%">İçerik türü adı</th>
                          <th style="font-weight: bold" width="20%">İçerik türü slug</th>
                          <th style="font-weight: bold" width="5%">Gösteri</th>
                          <th style="font-weight: bold" width="10%">Hareketler</th>
                      </tr>
                      @foreach($data as $row)
                      <tr id="tr_{{$row->id}}">
                          <td style="vertical-align: middle;padding:5px">{{ $row->contenttype_title }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->contenttype_slug }}</td>
                          <td style="vertical-align: middle;padding:5px;text-align:center">
                            <a href="{{ url('admin/contenttype/'.$row->contenttype_slug) }}" class="btn btn-info"  style="padding:3px;">
                              <i class="far fa-file-alt" style="color:gold;"></i>
                              Gösteri
                            </a>
                          </td>
                          <td style="vertical-align: middle;padding:5px;text-align:center">
                              <a href="{{ url('admin/edit_row_contenttype'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                              <button type="button" class="transparent_button contenttype_delete_button" 
                                      id="contenttype_delete_button{{$row->id}}" name="contenttype_delete_button{{$row->id}}" 
                                      data-modelname="Site_Content_Type" 
                                      data-id="{{$row->id}}" style="padding:3px"
                                      data-title="İçerik türünü sil" 
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
