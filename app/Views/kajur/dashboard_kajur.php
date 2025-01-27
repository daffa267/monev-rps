<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Utama</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="<?= base_url('css/gpmdashboard.css') ?>" rel="stylesheet">
</head>

<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <div class="sidebar-header-judul">
        <p>MONEV RPS</p>
      </div>
      <div class="sidebar-header">
        <p>Tahun Ajaran : 2024/2025 Ganjil</p>
      </div>
      <a href="<?= base_url('/kajur') ?>" class="menu-item">
        <i class="bi bi-speedometer2"></i><span>Halaman Utama</span>
      </a>
      <a href="<?= base_url('/dashboard/gpm_rps') ?>" class="menu-item">
        <i class="bi bi-file-earmark"></i><span>RPS</span>
      </a>
      <a href="<?= base_url('/gpm/bap') ?>" class="menu-item ">
        <i class="bi bi-file-earmark"></i><span>BAP</span>
      </a>
      <a href="<?= base_url('/gpm/notifikasi') ?>" class="menu-item">
        <i class="bi bi-bell-fill"></i><span>Notifikasi</span>
      </a>
      <a href="<?= base_url('/logout') ?>" class="menu-item">
        <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
      </a>
    </nav>

    <div class="admin-info">
      <span class="toggle-sidebar">&#9776;</span>

      <!-- Right-aligned container for profile and notification icons -->
      <div class="right-icons">
        <a href="<?= base_url('/gpm/profile') ?>" class="profile-link">
          <span class="admin-name"><?= user()->username ?></span>
          <i class="bi bi-person-fill"></i>
        </a>
        <a href="<?= base_url('/gpm/notifikasi') ?>" class="notif">
          <i class="bi bi-bell-fill"></i>
        </a>
      </div>
    </div>

    <div class="main-content">
      <header class="main-header">
        <h1 class="h4">Home / Dashboard KAJUR</h1>
      </header>
      <!-- Dashboard Cards -->
      <div class="container-fluid">
        <!-- Unggah RPS -->
        <div class="container-fluid">
          <div class="row">
            <!-- Unggah RPS -->
            <div class="col-md-3">
              <div class="custom-card">
                <i class="bi bi-file-earmark card-icon"></i>
                <div class="card-header">
                  <a href="<?= base_url('dashboard/gpm_rps') ?>" class="card-name">
                    <span>RPS</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="custom-card">
                <i class="bi bi-file-earmark-pdf-fill card-icon"></i>
                <div class="card-header">
                  <a href="<?= base_url('/gpm/bap') ?>" class="card-name">
                    <span>BAP</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="custom-card">
                <i class="bi bi-bell-fill card-icon"></i>
                <div class="card-header">
                  <a href="<?= base_url('/gpm/notifikasi') ?>" class="card-name">
                    <span>Notifikasi</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
  </footer>
  <script src="<?= base_url('/js/gpm.js') ?>"></script>
</body>

</html>