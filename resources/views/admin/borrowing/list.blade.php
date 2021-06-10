@foreach($borrowing as $spt)
   <ul>
      <span class="badge badge-primary">Npwp:&nbsp;{{ $spt->npwp }}</span>
      <span class="badge badge-danger">{{ $spt->typeSpt }}</span>
   </ul>
@endforeach