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
                            <!-- ------------------------End Flash Message---------------------- -->
                            <table class="table table-boardered table striped">
                                <tr class="header_tr">
                                    <th style="font-weight: bold" width="20%">Kullanıcı adı</th>
                                    <th style="font-weight: bold" width="20%">E-posta</th>
                                    <th style="font-weight: bold;text-align:center" width="20%">Yöneticisi mi?</th>
                                    <th style="font-weight: bold;text-align:center" width="20%">Yönetici ol</th>
                                    <th style="font-weight: bold;text-align:center" width="10%">Hareketler</th>
                                </tr>
                                @foreach($data as $row)
                                <tr id="tr_{{$row->id}}">
                                    <td style="vertical-align: middle;padding:5px">{{ $row->name }}</td>
                                    <td style="vertical-align: middle;padding:5px">{{ $row->email }}</td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">{{ $row->admin }}</td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                      <a href="{{ url('marka/'.$row->marka_slug) }}" class="btn btn-info" style="padding:3px;">
                                      <i class="fas fa-street-view" style="color:gold;"></i>
                                      </a>
                                    </td>
                                    <td style="vertical-align: middle;padding:5px;text-align:center">
                                        <button type="button" class="transparent_button filter_delete_button" 
                                                id="filter_delete_button{{$row->id}}" name="filter_delete_button{{$row->id}}" 
                                                data-modelname="Filter" 
                                                data-id="{{$row->id}}" style="padding:3px"
                                                data-title="Filter sil" 
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
