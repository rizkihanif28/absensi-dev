      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>">Presensi Online</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>">AO</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <?php if ($this->session->role_id == 3) { ?>
              <li class="<?= ($this->uri->segment(2) == 'presensi_all') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/presensi_all') ?>"><i class="far fa-user"></i> <span>Presensi All</span></a></li>
            <?php } else { ?>
              <li class="<?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
              <li class="<?= ($this->uri->segment(1) == 'absen') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('absen') ?>"><i class="fas fa-fingerprint"></i> <span>Presensi</span></a></li>
              <li class="<?= ($this->uri->segment(1) == 'profile') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('profile') ?>"><i class="far fa-user"></i> <span>Profile</span></a></li>
              <li class="<?= ($this->uri->segment(1) == 'lokasi') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('lokasi') ?>"><i class="far fa-map"></i> <span>Lokasi WFH</span></a></li>
            <?php } ?>
        </aside>
      </div>