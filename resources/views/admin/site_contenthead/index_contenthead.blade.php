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
                        <h4 class="page-title">Site ana içerikleri</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Site ana içerikler listesi</li>
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
                    <div class="col-md-12">
                        <div class="ml-auto text-right">
                        <button style="float: right;margin-bottom:5px" type="button" class="btn btn-info"  onclick="window.location.href = '{{ url('admin/add_contenthead') }}'">
                        <i class="fas fa-plus"></i>
                        Yeni ana içeriği ekle
                        </button>
                        </div>
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
                                    <th style="font-weight: bold" width="5%">İçerik türü</th>
                                    <th style="font-weight: bold" width="10%">İçerik başlığı</th>
                                    <th style="font-weight: bold" width="10%">İçerik slug</th>
                                    <th style="font-weight: bold" width="5%">Anahtar Kelimeler</th>
                                    <!-- <th style="font-weight: bold" width="20%">Başlık açıklaması</th>
                                    <th style="font-weight: bold" width="20%">İçerik tam açıklaması</th> -->
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
                                @foreach($data as $row)
                                    @if($i==1)
                                      <tr class="tr_{{$row->id}}" id="tr_1_{{$row->id}}">
                                    @else
                                      <tr class="header_body_tr tr_{{$row->id}}" id="tr_1_{{$row->id}}">
                                    @endif
                                    <td style="vertical-align: middle;padding:5px; color:#F78417;">{{ $row->site_content_type->contenttype_title }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->contenthead_title }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->contenthead_slug }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->contenthead_keywords }}</td>
                                    <!-- <td style="vertical-align: middle;padding:5px">{{ $row->contenthead_title_description }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->contenthead_description }}</td> -->
                                    <td style="padding:3px">
                                        @if($row->contenthead_image_name)
                                          <img class="rounded responsive modalImage" id="contenthead_image_preview" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $row->contenthead_image_name }}" alt="" name="contenthead_image_preview" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td style="padding:3px">
                                        @if($row->contenthead_logo_image_name)
                                          <img class="rounded responsive modalImage" id="contenthead_logo_image_preview" src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $row->contenthead_logo_image_name }}" alt="" name="contenthead_logo_image_preview" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                      <a href="{{ url('contenthead/'.$row->contenthead_slug) }}" class="btn btn-info" style="padding:3px;">
                                        <i class="far fa-file-alt" style="color:gold;"></i>
                                        Gösteri
                                      </a>
                                    </td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                      <a href="{{ url('admin/edit_row_contenthead'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                                      <button type="button" class="transparent_button contenthead_delete_button" 
                                          id="contenthead_delete_button{{$row->id}}" name="contenthead_delete_button{{$row->id}}" 
                                          data-contentheadid="{{$row->id}}"
                                          data-modelname="Site_Head_Content" 
                                          data-id="{{$row->id}}" style="padding:3px"
                                          data-title="Ana içeriği ({{ $row->site_content_type->contenttype_title }}) sil " 
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
                                    <td colspan="6">{{ $row->contenthead_title_description }}</td>
                                  @else
                                    <tr class="tr_{{$row->id}}" class="header_body_tr" id="tr_2_{{$row->id}}">
                                    <th class="header_body_tr" colspan="2" style="font-weight: bold;">Başlık açıklaması : </th>
                                    <td class="header_body_tr" colspan="6">{{ $row->contenthead_title_description }}</td>
                                  @endif
                                  </tr>    

                                  @if($i==1)
                                    <tr class="tr_{{$row->id}}" id="tr_3_{{$row->id}}">
                                    <th colspan="2" style="font-weight: bold;">İçerik tam açıklaması : </th>
                                    <td colspan="6">{{ $row->contenthead_description }}</td>
                                  @else
                                    <tr class="tr_{{$row->id}}" class="header_body_tr" id="tr_3_{{$row->id}}">
                                    <th class="header_body_tr" style="font-weight: bold;" colspan="2">İçerik tam açıklaması : </th>
                                    <td class="header_body_tr" colspan="6">{{ $row->contenthead_description }}</td>
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
                            {!! $data->links() !!}
                        </div>  <!-- "card"  --> 
                    </div>  <!-- "col-md-6"  --> 
                </div> <!-- End row  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            @endsection
