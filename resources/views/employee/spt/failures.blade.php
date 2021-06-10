@extends('template.coreTemplate')
@section('title', 'Kesalahan Import')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.spt.index') }}">Master Spt</a></div>
      <div class="breadcrumb-item">Kesalahan Import</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
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
            </div>
            <div class="card-body">
               @if(isset($failures))
                  @if ($failures)
                     <div class="alert alert-danger" role="alert">
                        <strong>Errors:</strong>
                        
                        <ul>
                           @foreach ($failures as $failure)
                              @foreach ($failure->errors() as $error)
                                 <li>{{ $error }}</li>
                              @endforeach
                              @foreach ($failure->values() as $key => $v)
                                 <li>{{ $v }}</li>
                              @endforeach
                           @endforeach
                        </ul>
                     </div>
                  @endif
               @endif
            </div>
         </div>
      </div>
   </div>
@endsection