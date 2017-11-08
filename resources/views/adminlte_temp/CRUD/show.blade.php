@extends('adminlte_layout.admin_lte')

@section('content-header')
<h1>
  Countries
  <small>Show</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#"><i class="fa fa-globe"></i> Countries</a></li>
  <li class="active">show</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>Name :</th>
                  <td>Egypt</td>
                </tr>
                <tr>
                  <th>Code :</th>
                  <td>EG</td>
                </tr>
                <tr>
                  <th>Currency :</th>
                  <td>EGP</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
