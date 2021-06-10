@extends('template.coreTemplate')
@section('title', 'Buat Jenis Pajaka')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.pajak.index') }}">Master Jenis Pajak</a></div>
      <div class="breadcrumb-item">Buat Jenis Pajaka</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Input Data</h4>
            </div>
            <div class="card-body">
            <form action="{{ route('admin.pajak.store') }}" method="post">
            @csrf
               <div class="form-group row">
                  <label for="taxType" class="col-sm-2 col-form-label">Jenis Pajak</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('taxType') is-invalid @enderror" name="taxType" placeholder="Jenis Pajak" value="{{ old('taxType') }}">
                     @error('taxType')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
         </div>
      </div>
   </div>
@endsection