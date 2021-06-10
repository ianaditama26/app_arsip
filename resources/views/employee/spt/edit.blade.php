@extends('template.coreTemplate')
@section('title', 'Edit Data Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('employee.spt.index') }}">Master Spt</a></div>
      <div class="breadcrumb-item">Edit Data Spt</div>
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
            <form action="{{ route('employee.spt.update', $spt->id) }}" method="post">
            @csrf
            @method('put')
               <div class="form-group row">
                  <label for="npwp" class="col-sm-2 col-form-label">Npwp</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" placeholder="Npwp" value="{{ $spt->npwp }}">
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
                     <input type="text" class="form-control @error('namaNpwp') is-invalid @enderror" name="namaNpwp" placeholder="Nama Npwp" value="{{ $spt->namaNpwp }}">
                     @error('namaNpwp')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="jenis_pajak" class="col-sm-2 col-form-label">Jenis Pajak</label>
                  <div class="col-sm-10">
                     <select nama="jenis_pajak" class="form-control @error('jenis_pajak') is-invalid @enderror" placeholder="Jenis Pajak">
                        <option value="{{ $spt->jenis_pajak }}">{{ $spt->jenis_pajak }}</option>
                        <option value=""></option>
                        @foreach($taxTypes as $taxType)
                           <option value="{{ $taxType->taxType }}">{{ $taxType->taxType }}</option>
                        @endforeach
                     </select>
                     @error('jenis_pajak')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="masa_pajak" class="col-sm-2 col-form-label">Masa Pajak</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('masa_pajak') is-invalid @enderror" name="masa_pajak" placeholder="Masa Pajak" value="{{ $spt->masa_pajak }}">
                     @error('masa_pajak')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="tahun_pajak" class="col-sm-2 col-form-label">Tahun Pajak</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('tahun_pajak') is-invalid @enderror" name="tahun_pajak" placeholder="Tahun Pajak" value="{{ $spt->tahun_pajak }}">
                     @error('tahun_pajak')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="pembetulan" class="col-sm-2 col-form-label">Pembetulan</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('pembetulan') is-invalid @enderror" name="pembetulan" placeholder="Pembetulan" value="{{ $spt->pembetulan }}">
                     @error('pembetulan')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="no_lpad" class="col-sm-2 col-form-label">No LPAD</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('no_lpad') is-invalid @enderror" name="no_lpad" placeholder="Status Pajak" value="{{ $spt->no_lpad }}">
                     @error('no_lpad')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="tgl_lpad" class="col-sm-2 col-form-label">Tgl LPAD</label>
                  <div class="col-sm-10">
                     <input type="date" class="form-control @error('tgl_lpad') is-invalid @enderror" name="tgl_lpad" placeholder="Tgl Pajak" value="{{ $spt->tgl_lpad }}">
                     @error('tgl_lpad')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="noUrut" class="col-sm-2 col-form-label">No Urut</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('noUrut') is-invalid @enderror" name="noUrut" placeholder="No Urut" value="{{ $spt->noUrut }}">
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
                     <input type="text" class="form-control @error('noBox') is-invalid @enderror" name="noBox" placeholder="No Box" value="{{ $spt->noBox }}">
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
                     <input type="text" class="form-control @error('noLemari') is-invalid @enderror" name="noLemari" placeholder="No Lemari" value="{{ $spt->noLemari }}">
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
                     <input type="text" class="form-control @error('catt') is-invalid @enderror" name="catt" placeholder="Catatan" value="{{ $spt->catt }}">
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