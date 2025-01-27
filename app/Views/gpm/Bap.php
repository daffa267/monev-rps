<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GPM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/css/bap_gpm.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
            <a href="<?= base_url('/gpm') ?>" class="menu-item">
                <i class="bi bi-speedometer2"></i><span>Halaman Utama</span>
            </a>
            <a href="<?= base_url('/dashboard/gpm_rps') ?>" class="menu-item">
                <i class="bi bi-file-earmark"></i><span>RPS</span>
            </a>
            <a href="<?= base_url('/gpm/bap') ?>" class="menu-item">
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

        <!-- Main Content Area -->
        <div class="main-content">
            <header class="main-header">
                <h1 class="h4">Home / BAP</h1>
            </header>
            <div class="content-wrapper">
                <!-- Table Section -->
                <section class="content-section">
                    <div class="container">
                        <h2 class="mb-4">Daftar Berita Acara Perkuliahan (BAP)</h2>
                        <table id="daftarBapTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mata Kuliah</th>
                                    <th>Kode MK</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bap_list as $key => $bap) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $bap['tanggal'] ?></td>
                                        <td><?= $bap['nama_mk'] ?></td>
                                        <td><?= $bap['kode_mk'] ?></td>
                                        <td><?= $bap['tempat'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info view-btn"
                                                data-id="<?= $bap['id'] ?>"
                                                data-tanggal="<?= $bap['tanggal'] ?>"
                                                data-mk="<?= $bap['nama_mk'] ?>"
                                                data-kode="<?= $bap['kode_mk'] ?>"
                                                data-tempat="<?= $bap['tempat'] ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    </div>
    </div>

    <!-- Footer dipindahkan ke luar main-content -->
    <footer class="footer">
        <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
    </footer>

    <!-- Modal untuk menampilkan detail BAP -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail BAP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Semua script dipindahkan ke luar main-content dan dashboard-container -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi komponen Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Toggle sidebar
            document.querySelector('.toggle-sidebar').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('collapsed');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View button handler
            const viewButtons = document.querySelectorAll('.view-btn');
            viewButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const bapId = this.getAttribute('data-id');

                    try {
                        // Tampilkan loading state
                        const viewContent = document.getElementById('viewContent');
                        viewContent.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

                        // Fetch BAP details
                        const response = await fetch(`/gpm/get-bap-details/${bapId}`);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const bapData = await response.json();

                        if (bapData.success) {
                            const hari = getDayName(bapData.bap.tanggal);
                            const formattedDate = formatDate(bapData.bap.tanggal);

                            // Generate view content
                            const content = `
                                <div style="font-family: 'Times New Roman', Times, serif; padding: 20px; border: 1px solid #000;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="width: 60px; vertical-align: middle;">
                                                <img src="/img/LOGO_UMRAH_PNG.png" alt="Logo" style="width: 150px; height: 150px;">
                                            </td>
                                            <td style="text-align: center;">
                                                <h4 style="margin: 0;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h4>
                                                <h4 style="margin: 0;">RISET, DAN TEKNOLOGI</h4>
                                                <h4 style="margin: 0;">UNIVERSITAS MARITIM RAJA ALI HAJI</h4>
                                                <h5 style="margin: 0; font-weight: bold;">FAKULTAS TEKNIK DAN TEKNOLOGI KEMARITIMAN</h5>
                                                <p style="margin: 0; font-size: 12px;">Jalan Politeknik Senggarang Telp. (0771) 4500097; Fax. (0771) 4500097</p>
                                                <p style="margin: 0; font-size: 12px;">PO.BOX 155 – Tanjungpinang 29100</p>
                                                <p style="margin: 0; font-size: 12px;">Website: <a href="http://fttk.umrah.ac.id/" target="_blank">http://fttk.umrah.ac.id/</a> e-mail: <a href="mailto:teknik@umrah.ac.id">teknik@umrah.ac.id</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr style="border: 1px solid #000;">
                                    <h5 style="text-align: center; font-weight: bold;">BERITA ACARA</h5>
                                    <h5 style="text-align: center; font-weight: bold;">REVIEW RENCANA PEMBELAJARAN SEMESTER (RPS)</h5>
                                    <p>Hari/tanggal: ${hari} / ${formattedDate}</p>
                                    <p>Tempat: ${bapData.bap.tempat}</p>
                                    <p>Nama MK / Kode MK: ${bapData.nama_mk} / ${bapData.bap.kode_mk}</p>
                                    <h6>Catatan review:</h6>
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr>
                                                <th style="border: 1px solid #000; padding: 5px; width: 5%;">No</th>
                                                <th style="border: 1px solid #000; padding: 5px; text-align: center;">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${bapData.review_notes.map((note, i) => `
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px; width: 5%;">${i + 1}</td>
                                                    <td style="border: 1px solid #000; padding: 5px;">${note.catatan}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            `;

                            viewContent.innerHTML = content;
                            const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                            viewModal.show();
                        } else {
                            throw new Error(bapData.message || 'Failed to load BAP data');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        document.getElementById('viewContent').innerHTML = `
                            <div class="alert alert-danger">
                                Terjadi kesalahan saat mengambil data BAP: ${error.message}
                            </div>
                        `;
                    }
                });
            });

            // Helper functions
            function getDayName(dateString) {
                const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                const date = new Date(dateString);
                return days[date.getDay()];
            }

            function formatDate(dateString) {
                const months = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                const date = new Date(dateString);
                const day = date.getDate();
                const month = months[date.getMonth()];
                const year = date.getFullYear();
                return `${day} ${month} ${year}`;
            }
        });
    </script>

    <script src="<?= base_url('/js/gpm.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

</body>

</html>