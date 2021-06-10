@extends('template.coreTemplate')
@section('title', 'Data Riwayat Peminjam')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item">Data Riwayat Peminjam</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Data Riwayat Peminjam</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Nama Peminjam</th>
                           <th>Npwp</th>
                           <th>Tipe Dokumen</th>
                           <th>Tanggal Pinjam</th>
                           <th>Jam Pinjam</th>
                           <th>Catatan</th>
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
@endpush

@push('scripts')
   <!-- DataTables -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

   <script>
      $(function() {
         $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "autoWidth": true,
            ajax: '{{ route('admin.dt.riwayat') }}',
            columns : [
               {data: 'DT_RowIndex'},
               {data: 'nama'},
               {data: 'npwp'},
               {data: 'typeSpt'},
               {data: 'date'},
               {data: 'time'},
               {data: 'catatan'},
            ]
         });
      })
   </script>

@endpush