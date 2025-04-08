 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/dashboard*') ? '' : 'collapsed' }}" href="/admin/dashboard">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-heading">Pengaturan Webiste</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/websites*') ? '' : 'collapsed' }}" href="/admin/websites">
                 <i class="bi bi-grid"></i>
                 <span>Daftar Webste</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-heading">Pengaturan User</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/website/user') ? '' : 'collapsed' }}" href="/admin/website/user">
                 <i class="bi bi-grid"></i>
                 <span>Daftar User</span>
             </a>
         </li><!-- End Dashboard Nav -->
         {{-- <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/website/user-admin*') ? '' : 'collapsed' }}"
                 href="/admin/website/user-admin">
                 <i class="bi bi-grid"></i>
                 <span>Daftar User Admin</span>
             </a>
         </li><!-- End Dashboard Nav --> --}}


 </aside><!-- End Sidebar-->
