<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah RPS</title>
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
                <h1 class="h4">Home / Unggah RPS</h1>
            </header>

            <!-- Tabel unggah RPS-->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Upload Dokumen RPS</th>
                                <th>Jurusan</th>
                                <th>Mata Kuliah</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rps as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><a href="linkRPS.html" onclick="passData(event, <?= $index + 1 ?>)" class="btn btn-sm btn-outline-primary btn-full-width">Upload RPS</a></td>
                                    <td>
                                        <select class="form-select prodi" onchange="updateMataKuliah(this)">
                                            <option value="" disabled selected>Pilih jurusan</option>
                                            <?php foreach ($prodi as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['nama_jurusan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select mata-kuliah" onchange="updateKodeMK(this)" disabled>
                                            <option value="" disabled selected>Pilih Mata Kuliah</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control kode" placeholder="Kode Mata Kuliah" readonly></td>
                                    <td>
                                        <select class="form-select tahun">
                                            <option disabled>Pilih Tahun Ajaran</option>
                                            <?php foreach ($tahun_ajaran as $ta): ?>
                                                <option value="<?= $ta ?>" <?= ($ta == $row['tahun_ajaran']) ? 'selected' : '' ?>><?= $ta ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select semester">
                                            <option disabled>Pilih Semester</option>
                                            <option value="Ganjil" <?= ($row['semester'] == 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
                                            <option value="Genap" <?= ($row['semester'] == 'Genap') ? 'selected' : '' ?>>Genap</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control kelas" placeholder="Kelas" value="<?= $row['kelas'] ?>"></td>
                                    <td><i class="bi bi-trash3-fill trash-icon" onclick="hapusBaris(this)" style="cursor: pointer;"></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-center my-3">
                        <button id="addRowButton" class="btn btn-primary">Tambah Baris</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Key untuk menyimpan data di localStorage
        const tableKey = "tableData";

        // Store all mata kuliah data grouped by jurusan
        const mataKuliahData = <?= json_encode($mata_kuliah) ?>;

        // Function to update mata kuliah dropdown based on selected jurusan
        function updateMataKuliah(prodiSelect) {
            const row = prodiSelect.closest('tr');
            const mataKuliahSelect = row.querySelector('.mata-kuliah');
            const kodeInput = row.querySelector('.kode');
            const selectedJurusanId = prodiSelect.value;

            // Reset mata kuliah dropdown and kode
            mataKuliahSelect.innerHTML = '<option value="" disabled selected>Pilih Mata Kuliah</option>';
            kodeInput.value = '';

            if (selectedJurusanId) {
                // Filter mata kuliah for selected jurusan
                const filteredMataKuliah = mataKuliahData.filter(mk => mk.id_jurusan === selectedJurusanId);

                // Populate mata kuliah dropdown
                filteredMataKuliah.forEach(mk => {
                    const option = document.createElement('option');
                    option.value = mk.nama_mk;
                    option.setAttribute('data-kode', mk.kode_mk);
                    option.textContent = mk.nama_mk;
                    mataKuliahSelect.appendChild(option);
                });

                // Enable mata kuliah select
                mataKuliahSelect.disabled = false;
            } else {
                // Disable mata kuliah select if no jurusan selected
                mataKuliahSelect.disabled = true;
            }
        }

        // Function to update kode MK when mata kuliah is selected
        function updateKodeMK(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const kodeMK = selectedOption.getAttribute('data-kode');
            const row = selectElement.closest('tr');
            const kodeInput = row.querySelector('.kode');
            kodeInput.value = kodeMK;
        }

        // Function to add new row
        function tambahBaris() {
            const tbody = document.querySelector("tbody");
            const maxRows = 100000;

            if (tbody.rows.length >= maxRows) {
                alert("Maksimal baris yang diperbolehkan telah tercapai!");
                return;
            }

            const rowCount = tbody.rows.length + 1;
            const newRow = document.createElement('tr');

            // Get prodi options from the first row and clone them
            const prodiOptions = Array.from(document.querySelector('.prodi').options)
                .map(opt => `<option value="${opt.value}" ${opt.disabled ? 'disabled' : ''}>${opt.text}</option>`)
                .join('');

            newRow.innerHTML = `
                <td>${rowCount}</td>
                <td><a href="#" onclick="passData(event, ${rowCount})" class="btn btn-sm btn-outline-primary btn-full-width">Upload RPS</a></td>
                <td>
                    <select class="form-select prodi" onchange="updateMataKuliah(this)">
                        ${prodiOptions}
                    </select>
                </td>
                <td>
                    <select class="form-select mata-kuliah" onchange="updateKodeMK(this)" disabled>
                        <option value="" disabled selected>Pilih Mata Kuliah</option>
                    </select>
                </td>
                <td><input type="text" class="form-control kode" placeholder="Kode Mata Kuliah" readonly></td>
                <td>
                    <select class="form-select tahun">
                        <option selected disabled>Pilih Tahun Ajaran</option>
                        <?php foreach ($tahun_ajaran as $ta): ?>
                            <option value="<?= $ta ?>"><?= $ta ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select class="form-select semester">
                        <option selected disabled>Pilih Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </td>
                <td><input type="text" class="form-control kelas" placeholder="Kelas"></td>
                <td><i class="bi bi-trash3-fill trash-icon" onclick="hapusBaris(this)" style="cursor: pointer;"></i></td>
            `;
            tbody.appendChild(newRow);

            saveTableData();
        }

        // Fungsi untuk menyimpan data tabel ke localStorage
        function saveTableData() {
            const tableRows = document.querySelectorAll("tbody tr");
            const tableData = Array.from(tableRows).map(row => {
                const mataKuliah = row.querySelector('.mata-kuliah')?.value || '';
                const kode = row.querySelector('.kode')?.value || '';
                const prodi = row.querySelector('.prodi')?.value || '';
                const tahun = row.querySelector('.tahun')?.value || '';
                const semester = row.querySelector('.semester')?.value || '';
                const kelas = row.querySelector('.kelas')?.value || '';

                return {
                    mataKuliah,
                    kode,
                    prodi,
                    tahun,
                    semester,
                    kelas
                };
            });

            localStorage.setItem(tableKey, JSON.stringify(tableData));
        }

        // Event listener untuk tombol "Tambah Baris"
        document.addEventListener("DOMContentLoaded", function() {
            // Hapus loadTableData() untuk mencegah loading otomatis
            const addRowButton = document.getElementById("addRowButton");
            if (addRowButton) {
                addRowButton.addEventListener("click", tambahBaris);
            }
        });

        // Fungsi untuk menghapus baris tertentu
        function hapusBaris(button) {
            const row = button.closest('tr');
            row.remove();
            updateRowNumbers();
            saveTableData();
        }

        function updateRowNumbers() {
            const tableRows = document.querySelectorAll("tbody tr");
            tableRows.forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });
        }

        // Fungsi untuk memvalidasi data dan berpindah halaman
        function passData(event, rowNum) {
            event.preventDefault();

            saveTableData();

            const row = document.querySelectorAll('tbody tr')[rowNum - 1];
            const mataKuliah = row.querySelector('.mata-kuliah').value.trim();
            const kode = row.querySelector('.kode').value.trim();
            const prodi = row.querySelector('.prodi').value.trim();
            const tahun = row.querySelector('.tahun').value.trim();
            const semester = row.querySelector('.semester').value.trim();
            const kelas = row.querySelector('.kelas').value.trim();

            if (!mataKuliah || !kode || prodi === "" || tahun === "" || semester === "" || !kelas) {
                return alert("Semua data harus diisi!");
            }

            const queryString = `?mataKuliah=${encodeURIComponent(mataKuliah)}&kode=${encodeURIComponent(kode)}&prodi=${encodeURIComponent(prodi)}&tahun=${encodeURIComponent(tahun)}&semester=${encodeURIComponent(semester)}&kelas=${encodeURIComponent(kelas)}`;
            window.location.href = `linkRPS${queryString}`;
        }

        // Fungsi pencarian
        document.getElementById('searchButton').addEventListener('click', function() {
            const mataKuliahPilihan = document.querySelector('.form-select[aria-label="Select Mata Kuliah"]').value;
            const semesterPilihan = document.querySelector('.form-select[aria-label="Select Semester"]').value;
            const tahunAjaranPilihan = document.querySelector('.form-select[aria-label="Select Academic Year"]').value;

            const rows = document.querySelectorAll('tbody tr');
            let found = false;

            rows.forEach(row => {
                const mataKuliah = row.querySelector('.mata-kuliah').value;
                const semester = row.querySelector('.semester').value;
                const tahun = row.querySelector('.tahun').value;

                const isMataKuliahMatch = mataKuliahPilihan === "Pilih Mata Kuliah" || mataKuliah === mataKuliahPilihan;
                const isSemesterMatch = semesterPilihan === "Pilih Semester" || semester === semesterPilihan;
                const isTahunMatch = tahunAjaranPilihan === "Pilih Tahun Ajaran" || tahun === tahunAjaranPilihan;

                if (isMataKuliahMatch && isSemesterMatch && isTahunMatch) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!found) {
                alert("Data tidak ditemukan!");
            }
        });

        document.getElementById('mataKuliahSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const kodeMk = selectedOption.value;
            document.getElementById('kodeMkInput').value = kodeMk;
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