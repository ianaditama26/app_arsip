@extends('template.coreTemplate')
@section('title', 'Detail Data Peminjam')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.peminjaman.index') }}">Data Peminjam</a></div>
      <div class="breadcrumb-item">Detail Data Peminjam</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Form peminjaman</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('admin.peminjaman.store') }}" method="post">
               @csrf
                  <div class="form-group row">
                     <label for="user_id" class="col-sm-2 col-form-label">User</label>
                     <div class="col-sm-10">
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="Jenis Pajak">
                           <option value="">Pilih</option>
                           <option value=""></option>
                           @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                           @endforeach
                        </select>
                        @error('user_id')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="spt_id" class="col-sm-2 col-form-label">Spt</label>
                     <div class="col-sm-10">
                        <select name="spt[]" class="form-control @error('spt') is-invalid @enderror multiSelect" placeholder="Jenis Pajak" multiple>
                           <option value="">Pilih</option>
                           <option value=""></option>
                           @foreach($spts as $spt)
                              <option value="{{ $spt->npwp }}"
                                 @if($spt->status == 1)
                                    disabled
                                 @endif>
                                 [{{ $spt->npwp }} | {{ $spt->namaNpwp }} | {{ $spt->getStatus() }}]
                              </option>
                           @endforeach
                        </select>
                        @error('spt')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nonSpt_id" class="col-sm-2 col-form-label">non Spt</label>
                     <div class="col-sm-10">
                        <select name="nonSpt[]" class="form-control @error('nonSpt') is-invalid @enderror multiSelect" placeholder="Jenis Pajak" multiple>
                           <option value="">Pilih</option>
                           <option value=""></option>
                           @foreach($nonSpts as $nonSpt)
                              <option value="{{ $nonSpt->npwp }}"
                                 @if($nonSpt->status == 1)
                                    disabled
                                 @endif>
                                 [{{ $nonSpt->npwp }} | {{ $nonSpt->namaNpwp }} | {{ $nonSpt->getStatus() }}]
                              </option>
                           @endforeach
                        </select>
                        @error('nonSpt')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="date" class="col-sm-2 col-form-label">Tanggal pinjam</label>
                     <div class="col-sm-10">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Tanggal Pinjam" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        @error('date')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="time" class="col-sm-2 col-form-label">Jam Pinjam</label>
                     <div class="col-sm-10">
                        <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" placeholder="Waktu Pinjam" value="{{ \Carbon\Carbon::now()->format('H:s') }}">
                        @error('time')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="time" class="col-sm-2 col-form-label">Catatan</label>
                     <div class="col-sm-10">
                        <textarea name="catt" id="" class="form-control" cols="160" rows="130"></textarea>
                        @error('time')
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
@push('styles')
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
   <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
   <script>
      $(function(){
         $('.multiSelect').select2({
               theme: 'bootstrap4'
         })
      })
   </script>
@endpush