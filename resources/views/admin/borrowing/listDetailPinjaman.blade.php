@foreach($histories as $borrowings)
   {{-- @foreach($borrowings->borrowing->detailBorrowing as $spt) --}}
      <ul>
         <span class="badge badge-primary">Npwp:&nbsp;{{ $borrowings->borrowing->id }}</span>
         {{-- <span class="badge badge-danger">{{ $spt->typeSpt }}</span> --}}
      </ul>
   {{-- @endforeach --}}
@endforeach