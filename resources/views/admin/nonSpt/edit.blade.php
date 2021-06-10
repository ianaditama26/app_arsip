@extends('template.coreTemplate')
@section('title', 'Edit Data Non Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.non-spt.index') }}">Master Non Spt</a></div>
      <div class="breadcrumb-item">Edit Data Non Spt</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Edit Data</h4>
            </div>
            <div class="card-body">
            <form action="{{ route('admin.non-spt.update', $nonSpt->id) }}" method="post">
            @csrf
            @method('put')
               <div class="form-group row">
                  <label for="npwp" class="col-sm-2 col-form-label">Npwp</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" placeholder="Npwp" value="{{ $nonSpt->npwp }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('namaNpwp') is-invalid @enderror" name="namaNpwp" placeholder="Nama Npwp" value="{{ $nonSpt->namaNpwp }}" autocomplete="off">
                     @error('namaNpwp')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="alamat" value="{{ $nonSpt->alamat }}" autocomplete="off">
                     @error('alamat')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="jenis_dokumen" class="col-sm-2 col-form-label">Jenis Dokumen</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" placeholder="Jenis Dokumen" value="{{ $nonSpt->jenis_dokumen }}" autocomplete="off">
                     @error('jenis_dokumen')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="no_dokumen" class="col-sm-2 col-form-label">No Dokumen</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" placeholder="No Dokumen" value="{{ $nonSpt->no_dokumen }}" autocomplete="off">
                     @error('no_dokumen')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noUrut" class="col-sm-2 col-form-label">No Urut</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('noUrut') is-invalid @enderror" name="noUrut" placeholder="No Urut" value="{{ $nonSpt->noUrut }}" autocomplete="off">
                     @error('noUrut')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noBox" class="col-sm-2 col-form-label">No Box</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('noBox') is-invalid @enderror" name="noBox" placeholder="No Box" value="{{ $nonSpt->noBox }}" autocomplete="off">
                     @error('noBox')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noLemari" class="col-sm-2 col-form-label">No Lemari</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('noLemari') is-invalid @enderror" name="noLemari" placeholder="No Lemari" value="{{ $nonSpt->noLemari }}" autocomplete="off">
                     @error('noLemari')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="catt" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('catt') is-invalid @enderror" name="catt" placeholder="Catatan" value="{{ $nonSpt->catt }}" autocomplete="off">
                     @error('catt')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-success">Ubah</button>
            </div>
            </form>
         </div>
      </div>
   </div>
@endsection