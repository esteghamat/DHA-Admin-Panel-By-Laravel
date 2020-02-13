@extends('layouts.adminLayout.admin_design')

@section('content')

<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
      <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
              <div class="form-group row">
                <label for="var1" class="col-sm-3 text-right control-label col-form-label">Var1 : </label>
                <div class="col-sm-9">
                    <label name="var1" class="col-sm-3 text-right control-label col-form-label">{{ $var1 }}</label>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group row">
                <label for="var1" class="col-sm-3 text-right control-label col-form-label">Var2 : </label>
                <div class="col-sm-9">
                    <label name="var1" class="col-sm-3 text-right control-label col-form-label">{{ $var2 }}</label>
                </div>
              </div>
          </div>  
      </div>  
  </div>  

@endsection