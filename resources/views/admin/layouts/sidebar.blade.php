 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link {{ Request::is('discord*') ? '' : 'collapsed' }}" href="/discord/data-role/view">
                 <i class="bi bi-grid"></i>
                 <span>Role Data</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Request::is('guild*') ? '' : 'collapsed' }}" href="/guild">
                 <i class="bi bi-discord"></i>
                 <span>Guild</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-heading">Pengaturan kelas</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('kategori*') ? '' : 'collapsed' }}" href="/kategori">
                 <i class="bi bi-bookmarks"></i>
                 <span>Kategori Kelas</span>
             </a>
         </li><!-- End Dashboard Nav -->
         {{-- <li class="nav-item">
             <a class="nav-link {{ Request::is('kelas*') ? '' : 'collapsed' }}" href="/kelas">
                 <i class="bi bi-collection-play-fill"></i>
                 <span>Kelas/Modul</span>
             </a>
         </li><!-- End Dashboard Nav --> --}}

         <li class="nav-item">
             <a class="nav-link {{ Request::is('kelas*') || Request::has('kategori') ? '' : 'collapsed' }}"
                 data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-collection-play-fill"></i>
                 <span>Kelas/Modul</span>
                 <i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="charts-nav"
                 class="nav-content collapse {{ Request::is('kelas*') || Request::has('kategori') ? 'show' : '' }}"
                 data-bs-parent="#sidebar-nav">

                 <li>
                     <a href="/kelas" class="{{ Request::is('kelas*') && !Request::has('kategori') ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Semua Kelas</span>
                     </a>
                 </li>

                 @foreach (kategori() as $kategori)
                     <li>
                         <a href="/kelas?kategori={{ $kategori->id }}"
                             class="{{ Request::get('kategori') == $kategori->id ? 'active' : '' }}">
                             <i class="bi bi-circle"></i><span>{{ $kategori->nm_kategori }}</span>
                         </a>
                     </li>
                 @endforeach
             </ul>
         </li>

         <li class="nav-heading">Pengaturan User</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('langganan*') ? '' : 'collapsed' }}" href="/langganan">
                 <i class="bi bi-bookmarks"></i>
                 <span>Langganan User</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/user*') ? '' : 'collapsed' }}" href="/admin/user">
                 <i class="bi bi-person-check"></i>
                 <span>User Admin</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-heading">Pengaturan Research</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/research*') ? '' : 'collapsed' }}" href="/admin/research">
                 <i class="bi bi-graph-up"></i>
                 <span>Research</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-heading">Pengaturan Home</li>
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/keanggotaan*') ? '' : 'collapsed' }}" href="/admin/keanggotaan">
                 <i class="bi bi-list-stars"></i>
                 <span>Keanggotaan</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/orderan*') ? '' : 'collapsed' }}" href="/admin/orderan">
                 <i class="bi bi-currency-dollar"></i>
                 <span>Orderan</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Request::is('admin/pixel*') ? '' : 'collapsed' }}" href="/admin/pixel ">
                 <i class="bi bi-facebook"></i>
                 <span>Pixel</span>
             </a>
         </li><!-- End Dashboard Nav -->


     </ul>

 </aside><!-- End Sidebar-->
