<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload RPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/unggah.css">
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
            <a href="/dosen/daftar_upload" class="menu-item submenu-item" id="daftarUploadRpsMenu" style="display: none;"><span>Daftar Upload RPS</span></a>

            <a href="#" class="menu-item" id="menuBAP">
                <i class="bi bi-file-earmark-pdf-fill"></i><span>BAP</span>
                <i class="bi bi-chevron-left chevron-icon float-end"></i>
            </a>
            <a href="/dosen/isi_bap" class="menu-item submenu-item" id="isiBapMenu" style="display: none;"><span>Isi BAP</span></a>
            <a href="/dosen/daftar_bap" class="menu-item submenu-item" id="daftarBapMenu" style="display: none;"><span>Daftar BAP</span></a>


            <a href="/dosen/feedback" class="menu-item">
                <img src="/img/feedback.png" alt="Feedback Icon" class="feedback-icon"><span>Feedback RPS</span>
            </a>
            <a href="/dosen/notifikasi-rps" class="menu-item">
                <i class="bi bi-bell-fill"></i><span>Notifikasi</span>
            </a>
            <a href="/logout" class="menu-item">
                <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
            </a>
        </nav>

        <!-- Main content -->
        <div class="admin-info">
            <span class="toggle-sidebar">&#9776;</span>

            <!-- Right-aligned container for profile and notification icons -->
            <div class="right-icons">
                <a href="<?= base_url('/dosen/profile') ?>" class="profile-link">
                    <span class="admin-name"><?= user()->username ?></span>
                    <i class="bi bi-person-fill"></i>
                </a>
                <a href="<?= base_url('/dosen/notifikasi_rps') ?>" class="notif">
                    <i class="bi bi-bell-fill"></i>
                </a>
            </div>
        </div>

        <div class="main-content">
            <header class="main-header">
                <h1 class="h4">Home / Upload RPS</h1>
            </header>

            <div class="container mt-5">
                <div class="card mx-auto" style="max-width: 600px;">
                    <div class="card-body">
                        <h2 class="text-start">Upload Rencana Pembelajaran Semester</h2>
                        <!-- Single form -->
                        <form id="uploadForm" action="<?= base_url('dosen/simpan_rps') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="user_id" value="<?= user()->id ?>">
                            <div class="mb-3">
                                <label for="mataKuliah" class="form-label">Mata Kuliah</label>
                                <input type="text" class="form-control" id="mataKuliah" name="mataKuliah" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" id="kode" name="kode" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Prodi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" required>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="semester" name="semester" required>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="rpsLink" class="form-label">Masukkan Link RPS</label>
                                <input type="url" class="form-control" id="rpsLink" name="rpsLink" placeholder="https://drive.google.com/" required>
                                <div class="form-text text-muted">Masukkan link yang mengarah ke file RPS dalam format PDF.</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="/dosen" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to get query parameters
        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                mataKuliah: params.get('mataKuliah') || '',
                kode: params.get('kode') || '',
                prodi: params.get('prodi') || '',
                tahun: params.get('tahun') || '',
                semester: params.get('semester') || '',
                kelas: params.get('kelas') || ''
            };
        }

        // Populate form fields with values from query parameters
        document.addEventListener('DOMContentLoaded', function() {
            const {
                mataKuliah,
                kode,
                prodi,
                tahun,
                semester,
                kelas
            } = getQueryParams();
            document.getElementById('mataKuliah').value = mataKuliah;
            document.getElementById('kode').value = kode;
            document.getElementById('prodi').value = prodi;
            document.getElementById('tahun').value = tahun;
            document.getElementById('semester').value = semester;
            document.getElementById('kelas').value = kelas;
        });

        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;

            // Check if URL matches unggah-rps.html or related pages
            if (currentUrl.includes('unggah-rps.html') || currentUrl.includes('linkRPS.html')) {
                const unggahRpsMenu = document.getElementById('unggahRpsMenu');
                const menuRPS = document.getElementById('menuRPS');

                // Add 'active' class to highlight menu
                unggahRpsMenu.classList.add('active');
                menuRPS.classList.remove('active');

                // Ensure submenu is visible
                unggahRpsMenu.style.display = 'block';
            }
        });
    </script>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
    </footer>

    <script src="/js/dosen.js"></script>
    <!-- Scripts for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>