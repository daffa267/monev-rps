<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Dosen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/css/dosen copy.css">
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
      <a href="/dosen" class="menu-item active">
        <i class="bi bi-speedometer2"></i><span>Halaman Utama</span>
      </a>

      <a href="/dosen/menurps" class="menu-item" id="menuRPS">
        <i class="bi bi-file-earmark-arrow-up-fill"></i><span>RPS</span>
        <i class="bi bi-chevron-left chevron-icon float-end"></i>
      </a>
      <a href="/dosen/unggah-rps" class="menu-item submenu-item" id="unggahRpsMenu" style="display: none;"><span>Unggah RPS</span></a>
      <a href="dosen/daftar_upload" class="menu-item submenu-item" id="daftarUploadRpsMenu" style="display: none;"><span>Daftar Upload RPS</span></a>

      <a href="#" class="menu-item" id="menuBAP">
        <i class="bi bi-file-earmark-pdf-fill"></i><span>BAP</span>
        <i class="bi bi-chevron-left chevron-icon float-end"></i>
      </a>
      <a href="/dosen/isi_bap" class="menu-item submenu-item" id="isiBapMenu" style="display: none;"><span>Isi BAP</span></a>
      <a href="/dosen/daftar_bap" class="menu-item submenu-item" id="daftarBapMenu" style="display: none;"><span>Daftar BAP</span></a>


      <a href="/dosen/feedback" class="menu-item">
        <img src="/img/feedback.png" alt="Feedback Icon" class="feedback-icon"><span>Feedback RPS</span>
      </a>
      <a href="dosen/notifikasi_rps" class="menu-item">
        <i class="bi bi-bell-fill"></i><span>Notifikasi</span>
      </a>
      <a href="/logout" class="menu-item">
        <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
      </a>
    </nav>

    <?= $this->renderSection("main_content"); ?>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
  </footer>

  <script src="/js/dosen.js"></script>

  <!-- Scripts for Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jsPDF library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

</body>

</html>