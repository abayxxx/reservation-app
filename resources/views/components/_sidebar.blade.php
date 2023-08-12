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
             <a class="nav-link {{ request()->is('admin/kriteria') ? '' : 'collapsed' }}" href="{{ route('admin.kriteria') }}">
                 <i class="bi bi-database-add"></i>
                 <span>Data Kriteria</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/pertanyaan') ? '' : 'collapsed' }}" href="{{ route('admin.pertanyaan') }}">
                 <i class="bi bi-question-square-fill"></i>
                 <span>Data Pertanyaan</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ request()->is('admin/responden') ? '' : 'collapsed' }}" href="{{ route('admin.responden') }}">
                 <i class="bi bi-people-fill"></i>
                 <span>Data Responden</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link @if (request()->is('admin/ipa/tingkat-kesesuaian') || request()->is('admin/ipa/rata-rata') || request()->is('admin/ipa/keseluruhan-rata-rata') || request()->is('admin/ipa/pemetaan-atribut') || request()->is('admin/ipa/chart') || request()->is('admin/ipa/live-chat')) '' @else collapsed @endif" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-graph-up"></i>
                 <span>Analisis IPA</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content collapse @if (request()->is('admin/ipa/tingkat-kesesuaian') || request()->is('admin/ipa/rata-rata') || request()->is('admin/ipa/keseluruhan-rata-rata') || request()->is('admin/ipa/pemetaan-atribut') || request()->is('admin/ipa/chart') || request()->is('admin/ipa/live-chat')) show @else '' @endif " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('admin.ipa.tingkat-kesesuaian') }} " class="{{ request()->is('admin/ipa/tingkat-kesesuaian') ? 'active' : '' }}">
                         <i class="bi bi-circle "></i><span>Tingkat Kesesuaian</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.ipa.rata-rata') }}" class="{{ request()->is('admin/ipa/rata-rata') ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Rata-rata</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.ipa.keseluruhan-rata-rata') }}" class="{{ request()->is('admin/ipa/keseluruhan-rata-rata') ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Keseluruhan Rata-rata</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.ipa.pemetaan-atribut') }}" class="{{ request()->is('admin/ipa/pemetaan-atribut') ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Pemetaan Atribut</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.ipa.chart') }}" class="{{ request()->is('admin/ipa/chart') ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Chart</span>
                     </a>
                 </li>
             </ul>
         </li>

     </ul>

 </aside><!-- End Sidebar-->