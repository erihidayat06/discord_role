 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link {{ Request::is('discord*') ? '' : 'collapsed' }}" href="/discord/data-role/view">
                 <i class="bi bi-grid"></i>
                 <span>Role Data</span>
             </a>
         </li><!-- End Dashboard Nav -->
         {{-- <li class="nav-item">
             <a class="nav-link {{ Request::is('discord/data-role/view*') ? '' : 'collapsed' }}"
                 href="/discord/data-role/view">
                 <i class="bi bi-card-list"></i>
                 <span>Role Data</span>
             </a>
         </li><!-- End Dashboard Nav --> --}}



     </ul>

 </aside><!-- End Sidebar-->
