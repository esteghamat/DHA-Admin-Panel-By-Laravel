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
              <h4 class="page-title">Site öğeleri içeriği</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Site öğeleri içeriği listesi</li>
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
          <label class="col-md-2 text-left control-label col-form-label">İçerik türü seçin</label>
          <div class="col-md-4">
              <select class="select2 form-control custom-select text-left" name="input_contentitem_contenttype_id" id="input_contentitem_contenttype_id" style="width: 100%; height:36px;" >
                  @foreach ($data['contenttypes'] as $contenttype)
                    <option value="{{ $contenttype->id }}" data-contetnttypeslug="{{ $contenttype->contenttype_slug }}" 
                        @if($contenttype->id == $data['contenttype_id_default'])
                          selected="selected"
                        @endif  
                      >
                      {{ $contenttype->contenttype_title }}
                    </option>
                  @endforeach
              </select>
              @error('input_contentitem_contenttype_id')
                <div class="error_msg">{{ $message }}</div>
              @enderror
          </div>
          <div class="ml-auto col-md-2 text-right">
            <?php
              $url_additem = 'admin/add_contentitem/'.$data['contenttype_id_default'];
            ?>
            <button class="btn btn-info" id="btn_add_contentitem" style="float: right;margin-bottom:5px" type="button"  onclick="window.location.href = '{{ url($url_additem) }}'">
              <i class="fas fa-plus"></i>
              yeni öğe ekle
            </button>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div id="notice">
                  </div>
                  <!-- --------------------------Flash Message------------------------ -->
                  @if(Session::has('flash_message_error'))
                      <div class="alert alert-danger alert-block" style='margin-bottom: 0px'>
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
                  <thead>
                      <tr class="header_tr">
                          <th style="font-weight: bold" width="2%"><i class="fas fa-sort" style="padding:5px"></i></th>
                          <th style="font-weight: bold" width="5%">İçerik türü</th>
                          <th style="font-weight: bold" width="10%">İçerik başlığı</th>
                          <th style="font-weight: bold" width="10%">İçerik slug</th>
                          <th style="font-weight: bold" width="5%">Anahtar Kelimeler</th>
                          <th style="font-weight: bold" width="10%">Ana içerik görüntü</th>
                          <th style="font-weight: bold" width="10%">Ana içerik logo</th>
                          <th style="font-weight: bold" width="5%">Gösteri</th>
                          <th style="font-weight: bold" width="5%">Hareketler</th>
                      </tr>
                      </thead>    
                      <tbody>
                      <?php 
                        $i=1;
                      ?>
                      @foreach($data['contentitems'] as $row)
                          @if($i==1)
                            <tr class="tr_{{$row->id}}" id="tr_1_{{$row->id}}">
                          @else
                            <tr class="header_body_tr tr_{{$row->id}}" id="tr_1_{{$row->id}}">
                          @endif
                          <td style="vertical-align: middle;text-align: center;padding:5px;">
                            <input type="text" class="input_contentitem_custom_sorting" maxlength="2" size="1" 
                              name="input_contentitem_custom_sorting_{{$row->id}}" 
                              id="input_contentitem_custom_sorting_{{$row->id}}" 
                              data-id="{{$row->id}}" 
                              data-contenttype_id="{{$row->site_content_type_id}}" 
                              data-contetnttype_slug="{{$row->site_content_type->contenttype_slug}}" 
                              value="{{$row->custom_order}}">
                          </td>
                          <td style="vertical-align: middle;padding:5px; color:#F78417;">{{ $row->site_content_type->contenttype_title }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->contentitem_title }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->contentitem_slug }}</td>
                          <td style="vertical-align: middle;padding:5px">{{ $row->contentitem_keywords }}</td>
                          <td style="padding:3px">
                              @if($row->contentitem_image_name)
                                <img class="rounded responsive modalImage" id="contentitem_image_preview" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $row->contentitem_image_name }}" alt="" name="contentitem_image_preview" style="max-width: 100px; max-height: 100px;">
                              @endif
                          </td>
                          <td style="padding:3px">
                              @if($row->contentitem_logo_image_name)
                                <img class="rounded responsive modalImage" id="contentitem_logo_image_preview" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $row->contentitem_logo_image_name }}" alt="" name="contentitem_logo_image_preview" style="max-width: 100px; max-height: 100px;">
                              @endif 
                          </td>
                          <td style="vertical-align: middle;padding:5px;text-align:center">
                            <a href="{{ url('contentitem/' . $row->site_content_type->contenttype_slug . '/' . $row->contentitem_slug) }}" class="btn btn-info" style="padding:3px;">
                            <i class="far fa-file-alt" style="color:gold;"></i>
                              Gösteri
                            </a>
                          </td>
                          <td style="vertical-align: middle;padding:5px;text-align:center">
                            <a href="{{ url('admin/edit_row_contentitem/'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                            <button type="button" class="transparent_button contentitem_delete_button" 
                                id="contentitem_delete_button{{$row->id}}" name="contentitem_delete_button{{$row->id}}" 
                                data-contentitemid="{{$row->id}}"
                                data-modelname="Site_Content_Item" 
                                data-id="{{$row->id}}" style="padding:3px"
                                data-title="İçerik öğesini ({{ $row->contentitem_title }}) sil " 
                                data-toggle="modal" 
                                data-target="#confirmDelete" 
                                >
                                <i class="far fa-trash-alt" style="color:red; padding:5px"></i>
                            </button>                                       
                          </td>
                        </tr>    

                        @if($i==1)
                          <tr class="tr_{{$row->id}}" id="tr_2_{{$row->id}}">
                          <th colspan="2" style="font-weight: bold;">Başlık açıklaması : </th>
                          <td colspan="7">{{ $row->contentitem_title_description }}</td>
                        @else
                          <tr class="tr_{{$row->id}}" class="header_body_tr" id="tr_2_{{$row->id}}">
                          <th class="header_body_tr" colspan="2" style="font-weight: bold;">Başlık açıklaması : </th>
                          <td class="header_body_tr" colspan="7">{{ $row->contentitem_title_description }}</td>
                        @endif
                        </tr>    

                        @if($i==1)
                          <tr class="tr_{{$row->id}}" id="tr_3_{{$row->id}}">
                          <th colspan="2" style="font-weight: bold;">Tam açıklaması : </th>
                          <td colspan="7">{{ $row->contentitem_description }}</td>
                        @else
                          <tr class="tr_{{$row->id}}" class="header_body_tr" id="tr_3_{{$row->id}}">
                          <th class="header_body_tr" style="font-weight: bold;" colspan="2">Tam açıklaması : </th>
                          <td class="header_body_tr" colspan="7">{{ $row->contentitem_description }}</td>
                        @endif
                        </tr>    

                        @if($i==1)
                          <tr class="tr_{{$row->id}}" id="tr_4_{{$row->id}}">
                          <th colspan="1" style="font-weight: bold;">URL : </th>
                          <td colspan="4">{{ $row->contentitem_url }}</td>
                          <th colspan="1" style="font-weight: bold;">Filter : </th>
                          <td colspan="1">{{ isset($row->filter->filter_name) ? $row->filter->filter_name : '' }}</td>
                          <th colspan="1" style="font-weight: bold;">Marka : </th>
                          <td colspan="1">{{ isset($row->marka->marka_name) ?  $row->marka->marka_name : '' }}</td>
                        @else
                          <tr class="tr_{{$row->id}}" class="header_body_tr" id="tr_4_{{$row->id}}">
                          <th class="header_body_tr" style="font-weight: bold;" colspan="1">URL : </th>
                          <td class="header_body_tr" colspan="4">{{ $row->contentitem_url }}</td>
                          <th class="header_body_tr" style="font-weight: bold;" colspan="1">Filter : </th>
                          <td class="header_body_tr" colspan="1">{{ isset($row->filter->filter_name) ? $row->filter->filter_name : '' }}</td>
                          <th class="header_body_tr" style="font-weight: bold;" colspan="1">Marka : </th>
                          <td class="header_body_tr" colspan="1">{{  isset($row->marka->marka_name) ?  $row->marka->marka_name : ''  }}</td>
                        @endif
                        </tr>    

                        @if($i==1)
                          <?php $i=2; ?>
                        @else
                          <?php $i=1; ?>
                        @endif

                      @endforeach     
                      </tbody>
                  </table>
                  {!! $data['contentitems']->links() !!}
              </div>  <!-- "card"  --> 
          </div>  <!-- "col-md-6"  --> 
      </div> <!-- End row  -->
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->

  @endsection
