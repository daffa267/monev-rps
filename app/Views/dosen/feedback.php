<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback RPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/feedback.css') ?>">
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
            <a href="/dosen/notifikasi_rps" class="menu-item">
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
                    <span class="admin-name"><?php echo user()->username  ?></span>
                    <i class="bi bi-person-fill"></i>
                </a>

                <a href="<?= base_url('/dosen/notifikasi_rps') ?>" class="notif">
                    <i class="bi bi-bell-fill"></i>
                </a>
            </div>
        </div>

        <div class="main-content">
            <!-- Administrator Info Container -->
            <header class="main-header">
                <h1 class="h4">Home / Feedback RPS</h1>
            </header>

            <!-- Dashboard Cards -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- Feedback RPS -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Dropdown untuk memilih RPS -->
                            <div class="mb-4">
                                <form action="" method="get" id="rpsSelectForm">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <label for="rps_id" class="form-label">Pilih RPS:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-select" name="rps_id" id="rps_id">
                                                <option value="">-- Pilih RPS --</option>
                                                <?php if (!empty($daftar_rps)): ?>
                                                    <?php foreach ($daftar_rps as $rps): ?>
                                                        <option value="<?= $rps->id ?>"
                                                            <?= ($selected_rps_id ?? '') == $rps->id ? 'selected' : '' ?>>
                                                            <?= esc($rps->nama_mk) ?> - <?= esc($rps->kelas) ?>
                                                            (<?= esc($rps->nama_jurusan) ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary">Tampilkan Review</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Debug information -->
                                <?php if (empty($daftar_rps)): ?>
                                    <div class="alert alert-warning mt-3">
                                        Tidak ada RPS yang tersedia.
                                        <?php if (ENVIRONMENT === 'development'): ?>
                                            <br>User ID: <?= user_id() ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (isset($selected_rps_id) && !empty($unsur_rps)): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Unsur RPS</th>
                                            <th>Status GPM</th>
                                            <th>Status Kajur</th>
                                            <th>Status Final</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($unsur_rps as $index => $unsur): ?>
                                            <?php
                                            $review = $reviews[$unsur->id_unsur] ?? null;
                                            $statusGpm = $review ? ($review->review_gpm ?: 'Belum diperiksa') : 'Belum diperiksa';
                                            $statusKajur = $review ? ($review->review_kajur ?: 'Belum diperiksa') : 'Belum diperiksa';

                                            $statusFinal = 'Belum diperiksa';
                                            if ($statusGpm !== 'Belum diperiksa' || $statusKajur !== 'Belum diperiksa') {
                                                if ($statusGpm === 'Sesuai' && $statusKajur === 'Sesuai') {
                                                    $statusFinal = 'Sesuai';
                                                } else if ($statusGpm === 'Revisi' || $statusKajur === 'Revisi') {
                                                    $statusFinal = 'Revisi';
                                                }
                                            }

                                            $gpmClass = strtolower(str_replace(' ', '-', $statusGpm));
                                            $kajurClass = strtolower(str_replace(' ', '-', $statusKajur));
                                            $finalClass = strtolower(str_replace(' ', '-', $statusFinal));
                                            ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($unsur->unsur) ?></td>
                                                <td>
                                                    <span class="status-badge <?= $gpmClass ?>">
                                                        <?= esc($statusGpm) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="status-badge <?= $kajurClass ?>">
                                                        <?= esc($statusKajur) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="status-badge <?= $finalClass ?>">
                                                        <?= esc($statusFinal) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($review && ($review->catatan_gpm || $review->catatan_kajur)): ?>
                                                        <button type="button"
                                                            class="btn btn-sm btn-info view-feedback"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#feedbackModal"
                                                            data-catatan-gpm="<?= esc($review->catatan_gpm ?: 'Belum ada catatan') ?>"
                                                            data-catatan-kajur="<?= esc($review->catatan_kajur ?: 'Belum ada catatan') ?>">
                                                            <i class="bi bi-eye"></i> Lihat Catatan
                                                        </button>
                                                    <?php else: ?>
                                                        <span class="text-muted">Belum ada catatan</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php elseif (isset($selected_rps_id)): ?>
                                <div class="alert alert-info">
                                    Belum ada review untuk RPS ini.
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    Silakan pilih RPS untuk melihat review.
                                </div>
                            <?php endif; ?>

                            <!-- Modal untuk menampilkan catatan -->
                            <div class="modal fade" id="feedbackModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Catatan Review</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <h6>Catatan GPM:</h6>
                                                <p id="feedbackTextGpm" class="border p-2 rounded"></p>
                                            </div>
                                            <div>
                                                <h6>Catatan Kajur:</h6>
                                                <p id="feedbackTextKajur" class="border p-2 rounded"></p>
                                            </div>
                                        </div>
                                    </div>
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


    <script>
        $(document).ready(function() {
            // Auto-submit form when selecting RPS
            $('#rps_id').change(function() {
                if ($(this).val()) {
                    $('#rpsSelectForm').submit();
                }
            });

            // Handle modal feedback
            // $('.view-feedback').click(function() {
            //     const catatanGpm = $(this).data('catatan-gpm');
            //     const catatanKajur = $(this).data('catatan-kajur');

            //     // Ensure default text if no notes
            //     $('#feedbackTextGpm').text(catatanGpm || '');
            //     $('#feedbackTextKajur').text(catatanKajur || '');
            // });
        });
    </script>

    <script src="/js/dosen.js"></script>

    <!-- Scripts for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tambahan CSS untuk status badge -->
    <style>
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
            text-align: center;
            min-width: 120px;
        }

        .status-badge.sesuai {
            background-color: #28a745;
            color: white;
        }

        .status-badge.revisi {
            background-color: #dc3545;
            color: white;
        }

        .status-badge.belum-diperiksa {
            background-color: #6c757d;
            color: white;
        }

        /* Styling untuk modal */
        .modal-body p {
            margin-bottom: 0;
            min-height: 40px;
            background-color: #f8f9fa;
        }

        .modal-body h6 {
            color: #495057;
            margin-bottom: 5px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle modal feedback
            const viewFeedbackButtons = document.querySelectorAll('.view-feedback');
            viewFeedbackButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const catatanGpm = this.getAttribute('data-catatan-gpm');
                    const catatanKajur = this.getAttribute('data-catatan-kajur');

                    document.getElementById('feedbackTextGpm').textContent = catatanGpm;
                    document.getElementById('feedbackTextKajur').textContent = catatanKajur;
                });
            });
        });
    </script>
</body>

</html>