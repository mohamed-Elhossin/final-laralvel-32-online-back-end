  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->


          <li class="nav-heading">Pages</li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.index') }}">
                  <i class="bi bi-person"></i>
                  <span>Admins</span>
              </a>
          </li><!-- End Profile Page Nav -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('profile.edit') }}">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li><!-- End Profile Page Nav -->

      </ul>

  </aside><!-- End Sidebar-->
