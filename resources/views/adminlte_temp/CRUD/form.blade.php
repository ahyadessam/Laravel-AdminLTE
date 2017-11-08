@extends('adminlte_layout.admin_lte')

@section('content-header')
<h1>
  Countries
  <small>add</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#"><i class="fa fa-globe"></i> Countries</a></li>
  <li class="active">add</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        Create Country
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            @include('adminlte_temp.errors')
            @include('adminlte_temp.success')
            <form  action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Name<span class="red">*</span> :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="name" value="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Code<span class="red">*</span> :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="code" value="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">Currency<span class="red">*</span> :</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="text" name="currency" value="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12 text-center">
                  <input type="submit" name="" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
