@extends('template.coreTemplate')
@section('title', 'Buat Data Npwp')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.master-npwp.index') }}">Master Npwp</a></div>
      <div class="breadcrumb-item">Buat Data Npwp</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Input Data</h4>
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
            </div>
            <div class="card-body">
            <form action="{{ route('admin.master-npwp.store') }}" method="post">
            @csrf
               <div class="form-group row">
                  <label for="npwp" class="col-sm-2 col-form-label">Npwp</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" placeholder="Npwp" value="{{ old('npwp') }}">
                     @error('npwp')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama Npwp" value="{{ old('nama') }}">
                     @error('nama')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat Npwp" value="{{ old('alamat') }}">
                     @error('alamat')
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