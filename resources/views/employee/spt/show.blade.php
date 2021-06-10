@extends('template.coreTemplate')
@section('title', 'Detail Data Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('employee.spt.index') }}">Master Spt</a></div>
      <div class="breadcrumb-item">Detail Data Spt</div>
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
                     {{ $spt->npwp }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                     {{ $spt->namaNpwp }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="jenis_pajak" class="col-sm-2 col-form-label">Jenis Pajak</label>
                  <div class="col-sm-10">
                     {{ $spt->jenis_pajak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="masa_pajak" class="col-sm-2 col-form-label">Masa Pajak</label>
                  <div class="col-sm-10">
                     {{ $spt->masa_pajak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="tahun_pajak" class="col-sm-2 col-form-label">Tahun Pajak</label>
                  <div class="col-sm-10">
                     {{ $spt->tahun_pajak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="status_pajak" class="col-sm-2 col-form-label">Status Pajak</label>
                  <div class="col-sm-10">
                     {{ $spt->status_pajak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="no_lpad" class="col-sm-2 col-form-label">No LPAD</label>
                  <div class="col-sm-10">
                     {{ $spt->no_lpad }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="tgl_lpad" class="col-sm-2 col-form-label">Tgl LPAD</label>
                  <div class="col-sm-10">
                     {{ $spt->tgl_lpad }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noBox" class="col-sm-2 col-form-label">No Box</label>
                  <div class="col-sm-10">
                     {{ $spt->noBox }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noLemari" class="col-sm-2 col-form-label">No Lemari</label>
                  <div class="col-sm-10">
                     {{ $spt->noLemari }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="catt" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                     {{ $spt->catt }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection