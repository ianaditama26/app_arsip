@extends('template.coreTemplate')
@section('title', 'Buat Data Non Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.non-spt.index') }}">Master Non Spt</a></div>
      <div class="breadcrumb-item">Buat Data Non Spt</div>
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
            <form action="{{ route('admin.non-spt.store') }}" method="post">
            @csrf
               <div class="form-group row">
                  <label for="npwp" class="col-sm-2 col-form-label">Npwp</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" placeholder="Npwp" id="npwp" value="{{ old('npwp') }}" autocomplete="off">

                     <div class="invalid-feedback">
                        Npwp tidak ada
                     </div>

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
                     <input type="text" class="form-control @error('namaNpwp') is-invalid @enderror" name="namaNpwp" placeholder="Nama Npwp" id="nama" value="{{ old('namaNpwp') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="alamat" id="alamat" value="{{ old('alamat') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" placeholder="Jenis Dokumen" value="{{ old('jenis_dokumen') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" placeholder="No Dokumen" value="{{ old('no_dokumen') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('noUrut') is-invalid @enderror" name="noUrut" placeholder="No Urut" value="{{ old('noUrut') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('noBox') is-invalid @enderror" name="noBox" placeholder="No Box" value="{{ old('noBox') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('noLemari') is-invalid @enderror" name="noLemari" placeholder="No Lemari" value="{{ old('noLemari') }}" autocomplete="off">
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
                     <input type="text" class="form-control @error('catt') is-invalid @enderror" name="catt" placeholder="Catatan" value="{{ old('catt') }}" autocomplete="off">
                     @error('catt')
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
@push('scripts')

<script>
   $(document).ready(function(){
      $('#npwp').change(function(){
         let npwp = $(this).val();

         $.ajax({
            type: "post",
            url: "{{ route('admin.spt.checkAvailableNpwp') }}",
            data: {
               "_token" : "{{ csrf_token() }}",
               "npwp" : npwp,
            },
            beforeSend: function(){
               $("#npwp").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 130px");
            },
            dataType: 'json',
            success: function(data){
               if(data.success === true){
                  alert(data.message);
                  $("#npwp").css("background","#FFF");
                  $("#npwp").removeClass('is-invalid');
                  $("#npwp").addClass('is-valid');

                  $("#nama").removeClass('is-invalid');
                  $("#nama").addClass('is-valid');

                  $("#alamat").removeClass('is-invalid');
                  $("#alamat").addClass('is-valid');


                  $('#nama').val(data.npwp.nama);
                  $('#alamat').val(data.npwp.alamat);
               }else if(data.success === false) {
                  alert(data.message);
                  $('#npwp').val('');
                  $('#nama').val('');
                  $('#alamat').val('');
                  $("#npwp").removeClass('is-valid');
                  $("#npwp").addClass('is-invalid');
                  $("#npwp").css("background","#FFF");
               }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
         });
      })
   })
</script>
@endpush