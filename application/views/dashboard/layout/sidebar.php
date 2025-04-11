<ul class="navbar-nav sidebar sidebar-dark" id="accordionSidebar" style="background-color: #00AAC1;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img
            src="<?= asset_url('img/logo/group.png') ?>"
            alt="Rslogo"
            class="img-fluid"
            style="max-width: 50px;"
        />    
        <div class="sidebar-brand-text mx-3">Endoskopi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 18px;">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading" style="font-size: 15px;">
        Menu
    </div>

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('history') ?>">
            <i class="fas fa-fw fa-folder"></i>
            <span style="font-size: 18px;">History Endoskopi</span>
        </a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pelaksanaan') ?>">
            <i class="fas fa-fw fa-folder"></i>
            <span style="font-size: 18px;">Pelaksanaan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-folder"></i>
            <span style="font-size: 18px;">Laporan</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user') ?>" style="font-size: 18px;">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            <span style="font-size: 18px;">Management User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span style="font-size: 18px;">Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>