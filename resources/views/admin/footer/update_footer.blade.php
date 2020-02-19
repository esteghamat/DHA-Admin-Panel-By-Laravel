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
              <h4 class="page-title">Sayfa altbilgisi</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Düzenle sayfa altbilgisi</li>
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
                  <form class="form-horizontal" method='POST' action="{{ url('/admin/footer') }}" name="update_footer" id="update_footer" enctype="multipart/form-data" >
                      {{ csrf_field() }}
                      <div class="card-body">
                          <h4 class="card-title">Düzenle Sayfa altbilgisi</h4>
                          <div class="form-group row">
                              <label for="input_footer_whatsapp" class="col-sm-3 text-right control-label col-form-label">whatsapp</label>
                              <div class="col-sm-9">
                                  <?php
                                    $value = '';
                                    if(isset($data->whatsapp)) 
                                      { $value = $data->whatsapp; }  
                                    else 
                                      { $value = '0533 613 1073'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_whatsapp" id="input_footer_whatsapp" placeholder=" " value="{{ old('input_footer_whatsapp' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_phone" class="col-sm-3 text-right control-label col-form-label">telefon</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->phone)) 
                                      { $value = $data->phone; }  
                                    else 
                                      { $value = '0216 32 70 48'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_phone" id="input_footer_phone" placeholder="" value="{{ old('input_footer_phone' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_email" class="col-sm-3 text-right control-label col-form-label">e-posta</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->email)) 
                                      { $value = $data->email; }  
                                    else 
                                      { $value = 'info@digitalhealtagency.com'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_email" id="input_footer_email" placeholder="" value="{{ old('input_footer_email' , $value) }}">
                                  @error('input_footer_email')
                                    <div class="error_msg">{{ $message }}</div>
                                  @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_address" class="col-sm-3 text-right control-label col-form-label">adres</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->address)) 
                                      { $value = $data->address; }  
                                    else 
                                      { $value = 'Kosuyolu Mahallesi Ali Nazime Sk.
                                        No 5/A Kadıkoy/İstanbul'; } 
                                  ?>
                                  <textarea class="form-control" name="input_footer_address" id="input_footer_address" placeholder="" >{{ old('input_footer_address' , $value) }} </textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_facebook" class="col-sm-3 text-right control-label col-form-label">facebook</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->facebook)) 
                                      { $value = $data->facebook; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_facebook" id="input_footer_facebook" placeholder="" value="{{ old('input_footer_facebook' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_twitter" class="col-sm-3 text-right control-label col-form-label">twitter</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->twitter)) 
                                      { $value = $data->twitter; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_twitter" id="input_footer_twitter" placeholder="" value="{{ old('input_footer_twitter' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_instagram" class="col-sm-3 text-right control-label col-form-label">instagram</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->instagram)) 
                                      { $value = $data->instagram; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_instagram" id="input_footer_instagram" placeholder="" value="{{ old('input_footer_instagram' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_linkedin" class="col-sm-3 text-right control-label col-form-label">linkedin</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->linkedin)) 
                                      { $value = $data->linkedin; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_linkedin" id="input_footer_linkedin" placeholder="" value="{{ old('input_footer_linkedin' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_kvkk_title" class="col-sm-3 text-right control-label col-form-label">KVKK başlığı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->kvkk_title)) 
                                      { $value = $data->kvkk_title; }  
                                    else 
                                      { $value = 'KVKK'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_kvkk_title" id="input_footer_kvkk_title" placeholder="" value="{{ old('input_footer_kvkk_title' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_kvkk_link" class="col-sm-3 text-right control-label col-form-label">KVKK bağlantısı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->kvkk_link)) 
                                      { $value = $data->kvkk_link; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_kvkk_link" id="input_footer_kvkk_link" placeholder="" value="{{ old('input_footer_kvkk_link' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_isortaklari_title" class="col-sm-3 text-right control-label col-form-label">İs ortakları başlığı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->isortaklari_title)) 
                                      { $value = $data->isortaklari_title; }  
                                    else 
                                      { $value = 'İs ortakları'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_isortaklari_title" id="input_footer_isortaklari_title" placeholder="" value="{{ old('input_footer_isortaklari_title' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_isortaklari_link" class="col-sm-3 text-right control-label col-form-label">İs ortakları bağlantısı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->isortaklari_link)) 
                                      { $value = $data->isortaklari_link; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_isortaklari_link" id="input_footer_isortaklari_link" placeholder="" value="{{ old('input_footer_isortaklari_link' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_partnerler_title" class="col-sm-3 text-right control-label col-form-label">Partnerler başlığı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->partnerler_title)) 
                                      { $value = $data->partnerler_title; }  
                                    else 
                                      { $value = 'Partnerler'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_partnerler_title" id="input_footer_partnerler_title" placeholder="" value="{{ old('input_footer_partnerler_title' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_partnerler_link" class="col-sm-3 text-right control-label col-form-label">Partnerler bağlantısı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->partnerler_link)) 
                                      { $value = $data->partnerler_link; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_partnerler_link" id="input_footer_partnerler_link" placeholder="" value="{{ old('input_footer_partnerler_link' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_kariyer_title" class="col-sm-3 text-right control-label col-form-label">Kariyer başlığı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->kariyer_title)) 
                                      { $value = $data->kariyer_title; }  
                                    else 
                                      { $value = 'Kariyer'; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_kariyer_title" id="input_footer_kariyer_title" placeholder="" value="{{ old('input_footer_kariyer_title' , $value) }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="input_footer_kariyer_link" class="col-sm-3 text-right control-label col-form-label">Kariyer bağlantısı</label>
                              <div class="col-sm-9">
                              <?php
                                    $value = '';
                                    if(isset($data->kariyer_link)) 
                                      { $value = $data->kariyer_link; }  
                                    else 
                                      { $value = ''; } 
                                  ?>
                                  <input type="text" class="form-control" name="input_footer_kariyer_link" id="input_footer_kariyer_link" placeholder="" value="{{ old('input_footer_kariyer_link' , $value) }}">
                              </div>
                          </div>
                          <input type="hidden" name="footer_id" id="footer_id" value="{{ isset($data->id) ? $data->id : 0 }}">
                      <div class="border-top">
                          <div class="card-body">
                              <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
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

