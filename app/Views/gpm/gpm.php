<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GPM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/gpm.css" rel="stylesheet">
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

        <!-- Main Content Area -->
        <div class="main-content">
            <header class="main-header">
                <h1 class="h4">Home / RPS</h1>
            </header>
            <div class="content-wrapper">

                <!-- Data RPS -->
                <div id="rps" class="container section">
                    <h4>Data RPS</h4>
                    <p>Informasi terkait RPS yang telah diunggah oleh dosen.</p>
                    <div class="mt-4">
                        <h5>Daftar File RPS yang Diupload</h5>
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>Tanggal Upload</th>
                                    <th>Link RPS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($daftarrps as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <?php foreach ($mata_kuliah as $mk): ?>
                                            <?php if ($mk['kode_mk'] == $value->kode_mk): ?>
                                                <td><?= $mk['nama_mk'] ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td><?= date('d M Y', strtotime($value->created_at)) ?></td>
                                        <td><a href="<?= $value->link_rps ?>" target="_blank"><i class="bi bi-eye"></i> View RPS</a></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning review-modal-btn" data-toggle="modal" data-target="#reviewModal" data-rps-id="<?= $value->id ?>">
                                                <i class="bi bi-pencil-square"></i> Review
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

    <footer class="footer">
        <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
    </footer>
    <!-- <script src="/js/gpm.js"></script> -->
    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Review RPS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm">
                        <input type="hidden" name="daftar_rps_id" id="daftar_rps_id">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Unsur RPS</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unsur as $index => $item): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $item->unsur ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-success status-btn"
                                                    data-unsur-id="<?= $item->id_unsur ?>" data-status="Sesuai">
                                                    <i class="bi bi-check-circle"></i> Ya
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger status-btn"
                                                    data-unsur-id="<?= $item->id_unsur ?>" data-status="Revisi">
                                                    <i class="bi bi-x-circle"></i> Tidak
                                                </button>
                                            </div>
                                            <input type="hidden" name="status[<?= $item->id_unsur ?>]" class="status-input">
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="catatan[<?= $item->id_unsur ?>]"
                                                rows="2" placeholder="Tambahkan catatan jika perlu"></textarea>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveReview">Simpan Review</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika modal review dibuka
            $('.review-modal-btn').click(function() {
                const rpsId = $(this).data('rps-id');
                $('#daftar_rps_id').val(rpsId);

                // Reset form
                $('#reviewForm')[0].reset();
                $('.status-btn').removeClass('active');
                $('.status-input').val('');
            });

            // Ketika tombol status diklik
            $('.status-btn').click(function(e) {
                e.preventDefault();
                const unsurId = $(this).data('unsur-id');
                const status = $(this).data('status');

                // Update visual state
                $(this).closest('.btn-group').find('.btn').removeClass('active');
                $(this).addClass('active');

                // Update hidden input dengan status yang dipilih
                $(this).closest('td').find('.status-input').val(status);

                // Debug log
                console.log(`Status updated for unsur ${unsurId}: ${status}`);
            });

            // Ketika form di-submit
            $('#saveReview').click(function(e) {
                e.preventDefault();

                // Validate form
                let isValid = true;
                $('.status-input').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        return false;
                    }
                });

                if (!isValid) {
                    alert('Mohon lengkapi status review untuk semua item');
                    return;
                }

                // Collect form data
                const formData = new FormData($('#reviewForm')[0]);

                // Debug: Log form data
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                // Send AJAX request
                $.ajax({
                    url: '/gpm/save-review',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Server response:', response);
                        if (response.success) {
                            alert('Review berhasil disimpan');
                            $('#reviewModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal menyimpan review: ' + (response.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax error:', {
                            xhr,
                            status,
                            error
                        });
                        alert('Terjadi kesalahan saat menyimpan review. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
    <style>
        .status-btn.active {
            opacity: 1;
        }

        .status-btn:not(.active) {
            opacity: 0.5;
        }

        .btn-group .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .modal-lg {
            max-width: 800px;
        }

        textarea.form-control {
            font-size: 0.875rem;
        }
    </style>

    <script src="<?= base_url('/js/gpm.js') ?>"></script>
</body>

</html>