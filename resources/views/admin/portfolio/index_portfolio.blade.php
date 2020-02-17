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
                        <h4 class="page-title">İşlerimiz</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">İşlerimiz listesi</li>
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
                        <button style="float: right;margin-bottom:5px" type="button" class="btn btn-info"  onclick="window.location.href = '{{ url('admin/add_portfolio') }}'">
                        <i class="fas fa-plus"></i>
                        Yeni iş ekle
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
                            <!-- $portfolio = App\Portfolio::find(1);
                            echo $portfolio->category->category_name; -->
                            <table class="table table-boardered table striped">
                                <tr class="header_tr">
                                    <th style="font-weight: bold" width="10%">Marka adı</th>
                                    <th style="font-weight: bold" width="15%">İş başlığı</th>
                                    <th style="font-weight: bold" width="15%">İş slug</th>
                                    <th style="font-weight: bold" width="15%">Anahtar Kelimeler</th>
                                    <th style="font-weight: bold" width="20%">İş açıklaması</th>
                                    <th style="font-weight: bold" width="15%">Filter adı</th>
                                    <th style="font-weight: bold" width="15%">Ana işi görüntü</th>
                                    <th style="font-weight: bold" width="5%">Gösteri</th>
                                    <th style="font-weight: bold" width="15%">Galeri görüntüleri</th>
                                    <th style="font-weight: bold" width="10%">Hareketler</th>
                                </tr>
                                @foreach($data as $row)
                                <tr id="tr_{{$row->id}}">
                                    <td style="vertical-align: middle;padding:5px">{{ $row->marka->marka_name }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->portfolio_title }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->portfolio_slug }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->portfolio_keywords }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->portfolio_description }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->filter->filter_name }}</td>
                                    <td style="padding:3px">
                                        <img class="rounded responsive modalImage" id="portfolio_image_preview" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $row->portfolio_image_name }}" alt="" name="portfolio_image_preview" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                      <a href="{{ url('portfolio/'.$row->portfolio_slug) }}" class="btn btn-info" style="padding:3px;">
                                      <i class="far fa-file-alt" style="color:gold;"></i>
                                        Gösteri
                                      </a>
                                    </td>
                                    <td style="vertical-align: middle;padding:5px;">
                                        <a href="{{ url('admin/index_insert_gallery_image/'.$row->id . '/' .$row->portfolio_title. '/' . 'portfolio' . '/' . 'işler' ) }}" style="padding:3px">
                                          <img class="rounded responsive modalImage" id="portfolio_image_preview" src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/assets/images/app_images/gallery_icon.jpg" alt="" style="max-width: 50px; max-height: 50px;"> 
                                        <span style="color:grey;">
                                        (
                                        <?php
                                            if(isset($row->get_galleries->gallery_image_count))
                                            {
                                                echo $row->get_galleries->gallery_image_count;
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                        ?>
                                        )
                                        </span>
                                        </a>
                                    </td>                                    
                                    {{-- <td style="vertical-align: middle;padding:5px">
                                        <a href="{{ url('admin/edit_row_portfolio'.$row->id) }}" class="btn btn-warning" style="padding:3px">Düzenle</a>
                                        <button type="button" class="btn btn-danger portfolio_delete_button" id="portfolio_delete_button{{$row->id}}" name="portfolio_delete_button{{$row->id}}" data-portfolioid="{{$row->id}}" style="padding:3px">İşi sil</button>
                                    </td> --}}
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                      <a href="{{ url('admin/edit_row_portfolio'.$row->id) }}"  style="padding:3px"><i class="fas fa-edit" style="color:#2A8DF5;"></i></a>
                                      <!-- <button type="button" class="transparent_button portfolio_delete_button" id="portfolio_delete_button{{$row->id}}" name="portfolio_delete_button{{$row->id}}" data-portfolioid="{{$row->id}}" style="padding:3px"><i class="fas fa-times" style="color:red; padding:5px"></i></button> -->
                                      <button type="button" class="transparent_button portfolio_delete_button" 
                                          id="portfolio_delete_button{{$row->id}}" name="portfolio_delete_button{{$row->id}}" 
                                          data-portfolioid="{{$row->id}}"
                                          data-modelname="Portfolio" 
                                          data-id="{{$row->id}}" style="padding:3px"
                                          data-title="İş sil" 
                                          data-toggle="modal" 
                                          data-target="#confirmDelete" 
                                          >
                                          <i class="far fa-trash-alt" style="color:red; padding:5px"></i>
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
