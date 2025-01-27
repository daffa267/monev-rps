<?= $this->extend('dosen/layouts/main') ?>


<?= $this->section('main_content') ?>

<!-- Main content -->
<div class="admin-info">
    <span class="toggle-sidebar">&#9776;</span>

    <!-- Right-aligned container for profile and notification icons -->
    <div class="right-icons">
        <a href="<?= base_url('dosen/profile') ?>" class="profile-link">
            <span class="admin-name"><?php echo user()->username ?></span>
            <i class="bi bi-person-fill"></i>
        </a>
        <a href="<?= base_url('dosen/notifikasi_rps') ?>" class="notif">
            <i class="bi bi-bell-fill"></i>
        </a>
    </div>
</div>

<div class="main-content">
    <!-- Administrator Info Container -->

    <header class="main-header">
        <h1 class="h4">Home / Dashboard Dosen</h1>
    </header>

    <!-- Dashboard Cards -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Unggah RPS -->
            <div class="col-md-3">
                <a href="<?= base_url('dosen/unggah-rps') ?>" class="custom-card-link">
                    <div class="custom-card">
                        <i class="bi bi-file-earmark-arrow-up-fill card-icon"></i>
                        <div class="card-header">
                            <span class="card-name">RPS</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Status BAP -->
            <div class="col-md-3">
                <a href="<?= base_url('dosen/isi_bap') ?>" class="custom-card-link">
                    <div class="custom-card">
                        <i class="bi bi-file-earmark-pdf-fill card-icon"></i>
                        <div class="card-header">
                            <span class="card-name">BAP</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Feedback RPS -->
            <div class="col-md-3">
                <a href="<?= base_url('dosen/feedback') ?>" class="custom-card-link">
                    <div class="custom-card bg-icon-feedback-box">
                        <div class="card-header">
                            <span class="card-name">Feedback RPS</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Notifikasi -->
            <div class="col-md-3">
                <a href="<?= base_url('dosen/notifikasi_rps') ?>" class="custom-card-link">
                    <div class="custom-card">
                        <i class="bi bi-bell-fill card-icon"></i>
                        <div class="card-header">
                            <span class="card-name">Notifikasi</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>