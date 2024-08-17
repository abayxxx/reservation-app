 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }}" href="{{ route('admin.dashboard')}}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-heading">FEATURE</li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/table') ? '' : 'collapsed' }}" href="{{ route('admin.table') }}">
                 <i class="bi bi-database-add"></i>
                 <span>Data Meja</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/menu') ? '' : 'collapsed' }}" href="{{ route('admin.menu') }}">
                 <i class="bi bi-question-square-fill"></i>
                 <span>Data Menu</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/order') ? '' : 'collapsed' }}" href="{{ route('admin.order') }}">
                 <i class="bi bi-people-fill"></i>
                 <span>Data Transaksi</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/reservation') ? '' : 'collapsed' }}" href="{{ route('admin.reservation') }}">
                 <i class="bi bi-people-fill"></i>
                 <span>Data Reservasi</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/report') ? '' : 'collapsed' }}" href="{{ route('admin.report') }}">
                 <i class="bi bi-people-fill"></i>
                 <span>Data Laporan</span>
             </a>
         </li>


     </ul>

 </aside><!-- End Sidebar-->