@extends('adminlte_layout.admin_lte')

@section('js-files')
<script src="{{ asset('admin-lte/lib/ckeditor/ckeditor.js') }}"></script>
@endsection

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
                <div class="col-xs-12">
                  <textarea name="editor" id="editor"></textarea>
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

@section('javascript')
<script>
$(function () {
  CKEDITOR.replace('editor', {
  	filebrowserBrowseUrl : '<?php echo url('admin-lte/lib/filemanager/dialog.php?type=2&editor=ckeditor&fldr='); ?>',
  	filebrowserUploadUrl : '<?php echo url('admin-lte/lib/filemanager/dialog.php?type=2&editor=ckeditor&fldr='); ?>',
  	filebrowserImageBrowseUrl : '<?php echo url('admin-lte/lib/filemanager/dialog.php?type=1&editor=ckeditor&fldr='); ?>',
    /* height: 600 */
  });
});
</script>
@endsection
