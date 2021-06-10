@extends('template.coreTemplate')
@section('title', 'Master Jenis Pajak')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item">Master Jenis Pajak</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Master Jenis Pajak</h4>
               <div class="card-header-action">
                  <a href="{{ route('admin.pajak.create') }}" class="btn btn-primary">
                     Buat data spt
                  </a>
               </div>
            </div>
            <div class="card-body">
               @if(session('message'))
               <div class="alert alert-primary alert-dismissible show fade">
                  <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                     <span>&times;</span>
                  </button>
                     {{ session('message') }}
                  </div>
               </div>
               @endif
               @if(session('error'))
               <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                     <span>&times;</span>
                  </button>
                     {{ session('error') }}
                  </div>
               </div>
               @endif
               <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Janis pajak</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($taxTypes as $taxType)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $taxType->taxType }}</td>
                              <td>
                                 <div class="btn-group">
                                 <a href="{{ route('admin.pajak.edit', $taxType->id) }}" class="btn btn-warning">
                                 Edit
                                 </a>

                                 <form action="{{ route('admin.pajak.destroy', $taxType->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <button type="sumit" class="btn btn-danger">Hapus</button>
                                 </form>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection