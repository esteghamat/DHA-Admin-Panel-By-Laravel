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
            <h4 class="page-title">Kategorylar</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Düzenle Kategory</li>
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
                <form class="form-horizontal" method='POST' action="{{ url('/admin/update_category') }}" name="add_kategory" id="add_kategory" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h4 class="card-title">Kategory ekle</h4>
                        <div class="form-group row">
                          <label class="col-md-3 text-right">Kategori seviyesi</label>
                          <div class="col-md-3">
                              <div class="custom-control custom-radio select-category-level">
                                @if($data->parent_id==0)
                                  <input type="radio" class="custom-control-input" id="input_category_level1" name="input_category_level_edit" value="mainCategory" disabled checked="checked" required>
                                @else  
                                  <input type="radio" class="custom-control-input" id="input_category_level1" name="input_category_level_edit" value="mainCategory" disabled required>
                                @endif  
                                  <label class="custom-control-label" for="input_category_level1">Ana Kategori</label>
                              </div>
                              <div class="custom-control custom-radio select-category-level">
                                @if($data->parent_id==0)
                                  <input type="radio" class="custom-control-input" id="input_category_level2" name="input_category_level" value="subCategory" disabled required>
                                @else  
                                  <input type="radio" class="custom-control-input" id="input_category_level2" name="input_category_level" value="subCategory" disabled checked="checked" required>
                                @endif  
                                  <label class="custom-control-label" for="input_category_level2">Alt kategori</label>
                              </div>
                          </div>
                          {{-- <div class="col-md-6"> --}}
                          {{-- <div class="form-group row"> --}}
                          <label class="col-md-2 text-right control-label col-form-label">Ana kategori seçin</label>
                          <div class="col-md-4">
                              <select class="select2 form-control custom-select" id="input_select_category_level_edit" name="input_select_category_level" style="width: 100%; height:36px;" value="{{ $data->parent_id }}" disabled>
                                <option value="">Seçin</option>
                                @foreach ($mainCategoryList as $categoryItem)
                                  @if(($data->parent_id!=0) and ($data->parent_id==$categoryItem->id))
                                    <option value="{{ $categoryItem->id }}" selected>{{ $categoryItem->category_name }}</option>
                                  @else  
                                    <option value="{{ $categoryItem->id }}">{{ $categoryItem->category_name }}</option>
                                  @endif  
                                @endforeach
                              </select>
                              <span id="categoryLevel_msg" class="error_msg"></span>
                              @error('input_select_category_level')
                                  <div class="error_msg">{{ $message }}</div>
                              @enderror
                          </div>
                          {{-- </div> --}}
                          {{-- </div> <!-- <div class="col-md-6"> --> --}}
                        </div> <!-- <div class="form-group row"> -->

                        <div class="form-group row">
                            <label for="input_category_name" class="col-sm-3 text-right control-label col-form-label">Kategory adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_category_name" id="input_category_name" placeholder="Kategory adı"  value="{{ $data->category_name }}">
                                <span id="categoryName_msg" class="error_msg"></span>
                                @error('input_category_name')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_category_slug" class="col-sm-3 text-right control-label col-form-label">Kategory Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_category_slug" id="input_category_slug" placeholder="Kategory slug"  value="{{ $data->category_slug }}">
                                <span id="categorySlug_msg"></span>
                                @error('input_category_name')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_category_description" class="col-sm-3 text-right control-label col-form-label">Kategory açıklaması</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="input_category_description" id="input_category_description" placeholder="Kategory açıklaması"  value="{{ $data->category_description }}">
                                <span id="kategoryDesc_msg"></span>
                            </div>
                        </div>
                        <input type="hidden" name="category_id" id="category_id" value="{{ $data->id }}">
                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" value="Değişiklikleri kaydet" class="btn btn-primary">
                            <button type="button" class="btn btn-success"  onclick="window.location.href = '{{ url('category') }}'">Kategorylar listesi</button>
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
