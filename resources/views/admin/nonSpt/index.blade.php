@extends('template.coreTemplate')
@section('title', 'Master Non Spt')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item">Master Non Spt</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Master Non Spt</h4>
               <div class="card-header-action">
                  <a href="{{ route('admin.non-spt.create') }}" class="btn btn-primary">
                     Buat data non spt
                  </a>

                  <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Import data spt</button>

                  <button class="btn btn-danger" data-toggle="modal" data-target="#modalExport">Export data spt</button>
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
                           <th>Npwp</th>
                           <th>Nama Npwp</th>
                           <th>Alamat</th>
                           <th>Jenis Dokumen</th>
                           <th>No Urut</th>
                           <th>No Box</th>
                           <th>No Lemari</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
@push('styles')
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

   <!--- Sweet alert -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
   <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Import Non Spt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('admin.non-spt.import') }}" method="post" enctype="multipart/form-data">
            @csrf
               <div class="form-group row">
                  <label class="col-sm-3 col-form-label">File Xlsx</label>
                  <div class="col-sm-9">
                     <input type="file" class="form-control" name="file">
                  </div>
               </div>
            
         </div>
         <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Import</button>
            </form>
         </div>
      </div>
      </div>
   </div>

   {{-- EXPORT --}}
   <div class="modal fade" tabindex="-1" role="dialog" id="modalExport">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Emport Spt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('admin.non-spt.export') }}" method="post" enctype="multipart/form-data">
            @csrf
               <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nomor box</label>
                  <div class="col-sm-9">
                     <select name="noBox" class="form-control" required>
                        <option value=""></option>
                        @foreach($noBox as $value)
                           <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            
         </div>
         <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Export</button>
            </form>
         </div>
      </div>
      </div>
   </div>
   <!-- DataTables -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

   <!-- Sweet alert -->
   <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
   $(function() {
      $('#dataTable').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "autoWidth": true,
         ajax: '{{ route('admin.dt.nonSpt') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'npwp'},
            {data: 'namaNpwp'},
            {data: 'alamat'},
            {data: 'jenis_dokumen'},
            {data: 'noUrut'},
            {data: 'noBox'},
            {data: 'noLemari'},
            {data: 'status'},
            {data: 'action'},
         ]
      });

      $('#dataTable').on('click', '#delete', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin hepus data ini?',
            text: "Data yang terhapus tidak bisa dikembalikan!",
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
                     url: "/admin/master/non-spt/" + id, // /'prefixnya'/controler atau classnya
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        if(data.success === true){
                           Swal.fire({
                           icon: 'error',
                           title: 'Oops...',
                           text: data.message
                           })
                        }else {
                           Swal.fire(
                           'Hapus data!',
                           'Data telah di hapus.',
                           'success'
                           )
                           location.reload(true);
                        }
                     },
               });
            }
         })
      });
   })
</script>
@endpush