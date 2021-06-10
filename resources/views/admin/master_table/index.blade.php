@extends('template.coreTemplate')
@section('title', 'Master Table')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item">Master Table</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Master Lemari</h4>
               <div class="card-header-action">
                  <a href="#" class="btn btn-primary">
                     Buat data
                  </a>
               </div>
            </div>
            <div class="card-body p-0">
               <div class="table-responsive">
                  <table class="table table-striped table-md">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                     <tr>
                        <td>1</td>
                        <td>Irwansyah Saputra</td>
                        <td>2017-01-09</td>
                        <td><div class="badge badge-success">Active</div></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Master Box</h4>
               <div class="card-header-action">
                  <a href="#" class="btn btn-primary">
                     Buat data
                  </a>
               </div>
            </div>
            <div class="card-body p-0">
               <div class="table-responsive">
                  <table class="table table-striped table-md">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                     <tr>
                        <td>1</td>
                        <td>Irwansyah Saputra</td>
                        <td>2017-01-09</td>
                        <td><div class="badge badge-success">Active</div></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection