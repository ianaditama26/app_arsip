@extends('template.coreTemplate')
@section('title', 'Detail Data Non Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('employee.non-spt.index') }}">Master Non Spt</a></div>
      <div class="breadcrumb-item">Detail Data Non Spt</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Detail Data</h4>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label for="npwp" class="col-sm-2 col-form-label">Npwp</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->npwp }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->namaNpwp }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->alamat }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="jenis_dokumen" class="col-sm-2 col-form-label">Jenis Dokumen</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->jenis_dokumen }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="no_dokumen" class="col-sm-2 col-form-label">No Dokumen</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->no_dokumen }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noUrut" class="col-sm-2 col-form-label">No Urut</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->noUrut }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noBox" class="col-sm-2 col-form-label">No Box</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->noBox }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noLemari" class="col-sm-2 col-form-label">No Lemari</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->noLemari}}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="catt" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                     {{ $nonSpt->catt }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
