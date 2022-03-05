<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ADMIN_ASSET}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Quiz Test System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <?php if (isset($_SESSION['teacher_id']) || isset($_SESSION['student_id'])) : ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ADMIN_ASSET}}dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php if (isset($_SESSION['teacher_id'])) : ?>
            <a href="#" class="d-block"><?= $_SESSION['teacher_name'] ?></a>
          <?php elseif (isset($_SESSION['student_id'])) : ?>
            <a href="#" class="d-block"><?= $_SESSION['student_name'] ?></a>
          <?php endif ?>
        </div>
      </div>
    <?php endif ?>
    @if (isset( $_SESSION['auth']['role_id']) == 1 || isset( $_SESSION['auth']['role_id'])==2)
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ADMIN_ASSET}}dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{$_SESSION['auth']['name']}}</a>
        </div>
      </div>
    @endif

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <!-- menu-open -->
          <a href="{{BASE_URL }}" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            <p>
              Môn học
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ BASE_URL . 'mon-hoc' }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{BASE_URL . 'mon-hoc/tao-moi'}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tạo mới</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{BASE_URL . 'quiz'}}" class="nav-link">
            <i class="fa fa-truck" aria-hidden="true"></i>
            <p>
              Quiz
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{BASE_URL . 'quiz'}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ BASE_URL . 'quiz/tao-moi'}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tạo mới</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
            <a href="{{BASE_URL . 'sv/mon-hoc'}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Làm quiz</p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>