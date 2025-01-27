<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/admin.css'); ?>">
</head>

<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-header-judul">
                <p>MONEV RPS</p>
            </div>
            <div class="sidebar-header">
                <p>Tahun Ajaran : 2024/2025 Ganjil</p>
            </div>
            <div class="menu-item">
                <i class=""></i> <a href="<?= base_url('/admin'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
  <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
</svg>Halaman Utama
            </a>
            </div>
            <div class="menu-item">
                <i class=""></i> <a href="<?= base_url('akun'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>Kelola Akun
                </a>
            </div>
            <div class="menu-item">
                <i class=""></i> <a href="<?= base_url('rps'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
</svg>Kelola RPS
                </a>
            </div>
            <div class="menu-item">
                <i class=""></i> <a href="<?= base_url('/logout'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
</svg>Keluar
                </a>
            </div>
        </nav>

        <div class="admin-info">
            <span class="toggle-sidebar">&#9776;</span>
            <span class="admin-name"><?php echo user()->username ?></span>
            <a href="<?= base_url('profil'); ?>"><i class="bi bi-person-fill"></i></a>
            <a href="<?= base_url('notif'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
</svg></a>
        </div>

        <div class="main-content">

            <header class="main-header">
                <h1 class="h4"><a href="<?= base_url('/'); ?>">Home</a> / <a href="<?= base_url('akun'); ?>">Kelola Akun</a> / Edit Akun</h1>
            </header>
            <div class="form-container">
                <form action="<?= base_url('edit/edituser/'.$user->id)?>" id="userForm" method="post" autocomplete="off">
                <?= csrf_field()  ?>

                    <label>Username:</label>
                    <input type="text" name="username" value="<?= esc($user->username) ?>" required>

                    <label>Password:</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">

                    <label>Nama:</label>
                    <input type="text" name="nama" value="<?= esc($userdetail->nama) ?>" required>

                    <label>NIDN:</label>
                    <input type="text" name="nidn" value="<?= esc($userdetail->nidn) ?>" required>

                    <label>Email:</label>
                    <input type="text" name="email" value="<?= esc($user->email) ?>" required>

                    <label>Fakultas:</label>
                    <select name="fakultas_id" required>
                        <option value="">Pilih Fakultas</option> <!-- Placeholder -->
                        <?php foreach ($fakultas as $fakultasItem): ?>
                            <option value="<?= $fakultasItem->id; ?>" 
                                <?= $fakultasItem->id == $userdetail->fakultas_id ? 'selected' : ''; ?>>
                                <?= esc($fakultasItem->nama_fakultas); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Jurusan:</label>
                    <select name="jurusan_id" required>
                        <option value="">Pilih Jurusan</option> <!-- Placeholder -->
                        <?php foreach ($jurusan as $jurusanItem): ?>
                            <option value="<?= $jurusanItem->id; ?>" 
                                <?= $jurusanItem->id == $userdetail->jurusan_id ? 'selected' : ''; ?>>
                                <?= esc($jurusanItem->nama_jurusan); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Peran:</label>
                    <select name="role_id" required>
                        <option value="">Pilih Role</option> <!-- Placeholder -->
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id; ?>" 
                                <?= $role->id == $user->role_id ? 'selected' : ''; ?>>
                                <?= esc($role->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                <button type="submit">edit Pengguna</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
    </footer>

    <script src="<?= base_url('js/dosen.js'); ?>"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>