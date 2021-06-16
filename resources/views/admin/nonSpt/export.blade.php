<table>
   <thead>
      <tr>
         <th>NO</th>
         <th>NPWP</th>
         <th>NAMA NPWP</th>
         <th>ALAMAT</th>
         <th>JENIS DOKUMEN</th>
         <th>NO DOKUMEN</th>
         <th>NO. BOX</th>
         <th>KODE LOKASI</th>
         <th>CATT</th>
      </tr>
   </thead>
   <tbody>
      @foreach($nonSpt as $v)
         <tr>
            <td>{{ $loop->iteration  }}</td>
            <td>{{ $v->npwp }}</td>
            <td>{{ $v->namaNpwp }}</td>
            <td>{{ $v->alamat }}</td>
            <td>{{ $v->jenis_dokumen }}</td>
            <td>{{ $v->no_dokumen }}</td>
            <td>{{ $v->noUrut }}</td>
            <td>{{ $v->noBox }}</td>
            <td>{{ $v->catt }}</td>
         </tr>
      @endforeach
   </tbody>
</table>