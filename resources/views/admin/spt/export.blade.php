<table>
   <thead>
      <tr>
         <th>NO</th>
         <th>NPWP</th>
         <th>NAMA NPWP</th>
         <th>JENIS PAJAK</th>
         <th>MASA PAJAK</th>
         <th>TAHUN PAJAK</th>
         <th>NO. LPAD</th>
         <th>TGL LPAD</th>
         <th>NO. BOX</th>
         <th>KODE LOKASI</th>
         <th>CATT</th>
      </tr>
   </thead>
   <tbody>
      @foreach($spt as $v)
         <tr>
            <td>{{ $loop->iteration  }}</td>
            <td>{{ $v->npwp }}</td>
            <td>{{ $v->namaNpwp }}</td>
            <td>{{ $v->jenis_pajak }}</td>
            <td>{{ $v->masa_pajak }}</td>
            <td>{{ $v->tahun_pajak }}</td>
            <td>{{ $v->no_lpad }}</td>
            <td>{{ $v->tgl_lpad }}</td>
            <td>{{ $v->noUrut }}</td>
            <td>{{ $v->noBox }}</td>
            <td>{{ $v->catt }}</td>
         </tr>
      @endforeach
   </tbody>
</table>