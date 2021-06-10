@extends('template.coreTemplate')
@section('title', 'Edit Data Peminjam')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.peminjaman.index') }}">Data Peminjam</a></div>
      <div class="breadcrumb-item">Edit Data Peminjam</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-6 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Form peminjaman SPT</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('admin.peminjaman.update', $borrowing->id) }}" method="post">
               @csrf
               @method('put')
               <div class="form-group row">
                  <label for="user_id" class="col-sm-2 col-form-label">User</label>
                  <div class="col-sm-10">
                     <input type="text" name="user_id" class="form-control" value="{{ $borrowing->user->name }}" readonly>
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
                     <select name="spt[]" class="form-control @error('spt') is-invalid @enderror multiSelect" multiple>
                        <option value="">Pilih . . .</option>
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
                     <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Tanggal Pinjam" value="{{ $borrowing->date }}">
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
                     <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" placeholder="Waktu Pinjam" value="{{ $borrowing->time }}">
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
                     <textarea name="catatan" id="" class="form-control" cols="160" rows="130">
                        {{ $borrowing->catatan }}
                     </textarea>
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

      <div class="col-6 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>List Dokumen</h4>
            </div>
            <div class="card-body">
               <table class="table tab-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Npwp</th>
                        <th>Type Spt</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($borrowing->detailBorrowing as $value)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $value->npwp }}</td>
                           <td>{{ $value->typeSpt }}</td>
                           <td>
                              <button type="submit" data-id="{{ $value->id }}" id="hapusFile" class="btn btn-danger">
                                 <span class="fa fa-trash"></span>
                              </button>
                              <a href="{{ route('admin.kembalikan.spt', $value->id) }}" class="btn btn-success">
                                 <span class="fa fa-check"></span>
                              </a>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
@endsection
@push('styles')
   <!--- Sweet alert -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
   <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

   <!-- Sweet alert -->
   <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
   <script>
      $(function(){
         $('.multiSelect').select2({
               theme: 'bootstrap4'
         })
      })

      $(document).on('click', '#hapusFile', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin hepus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batalkan!',
            }).then((result) => {
            if (result.value) {
               $.ajax({
                     type: "DELETE",
                     url: "/admin/spt/hapus-file/" + id,
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        Swal.fire(
                        'Hapus data!',
                        'Data telah di hapus.',
                        'success'
                        )
                        //setelah alert succes, maka reload halaman
                        location.reload(true);
                     },
               });
            }
         })
      });

       // alert
         var msg = '{{Session::get('alert')}}';
         var exist = '{{Session::has('alert')}}';
         if(exist){
            alert(msg);
         }
   </script>
@endpush