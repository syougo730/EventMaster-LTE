  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Event Master</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @auth
          
          <li class="nav-header">試合</li>

          <li class="nav-item">
            <a href="/event/create" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                試合登録
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/event/" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                試合一覧
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dscreator" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Ds.Creator
              </p>
            </a>
          </li>
              
          @endauth

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>