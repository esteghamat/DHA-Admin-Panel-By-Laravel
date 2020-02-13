@extends('layouts.adminLayout.admin_design')

@section('content')

<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
      <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Gallery_id</th>
                <th></th>
              </tr>
              </thead>
              @foreach($portfolios as $portfolio)
              <tbody>
              <tr>
                <td>{{ $portfolio->id }}</td>
                <td>{{ $portfolio->portfolio_title }}</td>
                <td>{{ (isset($portfolio->get_galleries->ref_id))? $portfolio->get_galleries->ref_id : 0}}</td>
                <td>{{ $portfolio->get_galleries->count() }}</td>
              </tr>
              </tbody>
              @endforeach
            </table>

            <br><br>

            {{-- <table class="table table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th></th>
                <th></th>
              </tr>
              </thead>
              @foreach($portfolios->get_galleries as $gallery)
              <tbody>
              <tr>
                <td>{{ $gallery->id }}</td>
                <td>{{ $gallery->ref_id }}</td>
                <td></td>
                <td></td>
              </tr>
              </tbody>
              @endforeach
            </table> --}}
            
          </div>  
      </div>  
  </div>  

@endsection