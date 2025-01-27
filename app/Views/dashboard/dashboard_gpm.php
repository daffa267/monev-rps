<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GPM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/gpm.css" rel="stylesheet">
</head>
<body>

    <!-- Dashboard Container -->
    <div class="dashboard-container">

        <!-- Sidebar untuk Navigasi -->
        <div class="sidebar">
            <div class="sidebar-header-judul">
                <p>Dashboard GPM</p>
            </div>
            <a href="#rekapLaporan" class="menu-item">Rekap Laporan</a>
            <a href="#rps" class="menu-item">Data RPS</a>
            <a href="#unsurRps" class="menu-item">Unsur RPS</a>
            <a href="#settings" class="menu-item">Pengaturan</a>
            <a href="/logout" class="menu-item">Logout</a>
        </div>

        <!-- Main Content with Admin Info -->
        <div class="admin-info">
            <div class="toggle-sidebar">&#9776;</div>
            <span class="admin-name">Nama Dosen</span>
            <span class="bi-person-fill">👤</span>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Ringkasan Rekap Laporan -->
            <div id="rekapLaporan" class="container section">
                <h4>Rekap Laporan</h4>
                <p>Data ringkasan rekap laporan RPS yang telah diunggah dan diselesaikan oleh dosen.</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="card-title">RPS Proses</h5>
                                <p class="card-text">30</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="card-title">RPS Selesai</h5>
                                <p class="card-text">90</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="card-title">Total RPS</h5>
                                <p class="card-text">120</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Data RPS -->
        <div id="rps" class="container section">
            <h4>Data RPS</h4>
            <p>Informasi terkait RPS yang telah diunggah oleh dosen.</p>
            <div class="mt-4">
                <h5>Daftar File RPS yang Diupload</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="fileList">
                        <!-- Daftar file akan muncul di sini -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Unsur RPS -->
        <div id="unsurRps" class="container section">
            <h4>Unsur RPS</h4>
            <p>Daftar unsur-unsur yang ada dalam RPS.</p>
<!-- Tabel Unsur RPS dengan Opsi Centang -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Unsur RPS</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Nama program studi</td>
            <td>
                <label><input type="radio" name="unsur1" value="Ada"> √</label>
                <label><input type="radio" name="unsur1" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Nama mata kuliah</td>
            <td>
                <label><input type="radio" name="unsur2" value="Ada"> √</label>
                <label><input type="radio" name="unsur2" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Kode mata kuliah</td>
            <td>
                <label><input type="radio" name="unsur3" value="Ada"> √</label>
                <label><input type="radio" name="unsur3" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Semester</td>
            <td>
                <label><input type="radio" name="unsur4" value="Ada"> √</label>
                <label><input type="radio" name="unsur4" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>SKS</td>
            <td>
                <label><input type="radio" name="unsur5" value="Ada"> √</label>
                <label><input type="radio" name="unsur5" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Nama Dosen Pengampu</td>
            <td>
                <label><input type="radio" name="unsur6" value="Ada"> √</label>
                <label><input type="radio" name="unsur6" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Kemampuan akhir yang direncanakan pada tiap tahapan pembelajaran untuk memenuhi capaian pembelajaran lulusan</td>
            <td>
                <label><input type="radio" name="unsur7" value="Ada"> √</label>
                <label><input type="radio" name="unsur7" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Bahan kajian yang terkait dengan kemampuan yang akan dicapai</td>
            <td>
                <label><input type="radio" name="unsur8" value="Ada"> √</label>
                <label><input type="radio" name="unsur8" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Metode Pembelajaran</td>
            <td>
                <label><input type="radio" name="unsur9" value="Ada"> √</label>
                <label><input type="radio" name="unsur9" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td>Waktu yang disediakan untuk mencapai kemampuan dalam setiap pembelajaran</td>
            <td>
                <label><input type="radio" name="unsur10" value="Ada"> √</label>
                <label><input type="radio" name="unsur10" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>11</td>
            <td>Pengalaman belajar mahasiswa yang diwujudkan dalam deskripsi tugas yang harus dikerjakan oleh mahasiswa selama satu semester</td>
            <td>
                <label><input type="radio" name="unsur11" value="Ada"> √</label>
                <label><input type="radio" name="unsur11" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>12</td>
            <td>Kriteria</td>
            <td>
                <label><input type="radio" name="unsur12" value="Ada"> √</label>
                <label><input type="radio" name="unsur12" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>13</td>
            <td>Indikator</td>
            <td>
                <label><input type="radio" name="unsur13" value="Ada"> √</label>
                <label><input type="radio" name="unsur13" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>14</td>
            <td>Bobot penilaian</td>
            <td>
                <label><input type="radio" name="unsur14" value="Ada"> √</label>
                <label><input type="radio" name="unsur14" value="Tidak"> ×</label>
            </td>
        </tr>
        <tr>
            <td>15</td>
            <td>Daftar referensi yang digunakan</td>
            <td>
                <label><input type="radio" name="unsur15" value="Ada"> √</label>
                <label><input type="radio" name="unsur15" value="Tidak"> ×</label>
            </td>
        </tr>
    </tbody>
</table>
        </div>

        <!-- Pengaturan -->
        <div id="settings" class="container section">
            <h4>Pengaturan</h4>
            <p>Kelola pengaturan akun dan preferensi lainnya.</p>
        </div>
        <div class="footer">
            <p>© 2024 Dashboard GPM. All rights reserved.</p>
        </div>

    </div>

</div>

<script src="script.js"></script>
</body>
</html>