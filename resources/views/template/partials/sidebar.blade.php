<div class="main-sidebar">
   <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
      <a href="index.html">Aplikasi ?</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
         <li>
            <a class="nav-link" href="/admin"><i class="fa fa-home"></i> <span>Dashboard</span></a>
         </li>
         @role('admin')
            <li>
               <a class="nav-link" href="{{ route('admin.master-npwp.index') }}"><i class="fa fa-sticky-note"></i> <span>Master Data Npwp</span></a>
            </li>

            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> <span>Master Data Spt</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('admin.spt.index') }}">Master Spt</a>
                  </li>
                  
                  <li>
                     <a class="nav-link" href="{{ route('admin.non-spt.index') }}">Master Non Spt</a>
                  </li>

                  <li>
                     <a class="nav-link" href="{{ route('admin.pajak.index') }}">Master Jenis Pajak</a>
                  </li>
               </ul>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.peminjaman.index') }}"><i class="fa fa-arrow-right"></i> <span>Peminjaman</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.riwayat.peminjaman') }}"><i class="fa fa-list"></i> <span>Riwayat Peminjaman</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fa fa-user"></i> <span>User Kontrol</span></a>
            </li>
         @else
            <li>
               <a class="nav-link" href="{{ route('employee.spt.index') }}"><i class="fa fa-sticky-note"></i> <span>Master Spt</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('employee.non-spt.index') }}"><i class="fa fa-sticky-note"></i> <span>Master Non Spt</span></a>
            </li>
         @endrole
   </aside>
</div>