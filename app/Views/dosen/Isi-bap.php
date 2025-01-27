<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/dosen copy.css">
    <link rel="stylesheet" href="/css/BAP.css">
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
            <!-- Administrator Info Container -->

            <header class="main-header">
                <h1 class="h4">Home / BAP</h1>
            </header>

            <!-- Dashboard Cards -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- Unggah RPS -->
                    <div class="bap-form-container">
                        <h2>Isi BAP (Berita Acara Perkuliahan)</h2>
                        <form action="<?= base_url('dosen/simpan_bap') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="user_id" value="<?= user()->id ?>">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="form-group">
                                <label for="mata-kuliah">Mata Kuliah</label>
                                <select id="mata-kuliah" name="kode_mk" required>
                                    <option value="">Pilih Mata Kuliah</option>
                                    <?php if (isset($mata_kuliah) && is_array($mata_kuliah)): ?>
                                        <?php foreach ($mata_kuliah as $mk): ?>
                                            <option value="<?= esc($mk['kode_mk']) ?>">
                                                <?= esc($mk['nama_mk']) ?> (<?= esc($mk['kode_mk']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" id="tempat" name="tempat" placeholder="Masukkan nama tempat" required>
                            </div>

                            <div class="form-group">
                                <label for="materi">Catatan Review</label>
                                <div id="catatanReviewContainer">
                                    <div class="line-item">
                                        <span class="line-number">1.</span>
                                        <input type="text" class="line-input" name="catatan[]" placeholder="Masukkan catatan..." required />
                                        <button type="button" class="delete-line-btn">x</button>
                                    </div>
                                </div>
                                <button type="button" id="addLineButton" class="add-line-btn">Tambah Baris</button>
                            </div>

                            <div class="button-group">
                                <button type="submit" class="save-btn">Simpan BAP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const catatanReviewContainer = document.getElementById('catatanReviewContainer');

        function addNewLine() {
            const lineItems = catatanReviewContainer.getElementsByClassName('line-item');
            const newIndex = lineItems.length + 1; // Get the next line number

            // Create new line item
            const newLineItem = document.createElement('div');
            newLineItem.classList.add('line-item');
            newLineItem.innerHTML = `
                <span class="line-number">${newIndex}.</span>
                <input type="text" class="line-input" name="catatan[]" placeholder="Masukkan catatan..." required />
                <button type="button" class="delete-line-btn">x</button>
            `;

            // Append new line item to container
            catatanReviewContainer.appendChild(newLineItem);

            // Focus on the new input
            const newInput = newLineItem.querySelector('.line-input');
            newInput.focus();

            // Add event listener to the new input
            newInput.addEventListener('keypress', handleEnterKey);

            // Add event listener to the delete button
            newLineItem.querySelector('.delete-line-btn').addEventListener('click', function() {
                newLineItem.remove();
                updateLineNumbers();
            });
        }

        // Event listener for Enter key
        function handleEnterKey(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addNewLine();
            }
        }

        // Update line numbers after a line is removed
        function updateLineNumbers() {
            const lineItems = catatanReviewContainer.getElementsByClassName('line-item');
            Array.from(lineItems).forEach((item, index) => {
                item.querySelector('.line-number').textContent = `${index + 1}.`;
            });
        }

        // Add the initial event listeners
        document.querySelectorAll('.line-input').forEach(input => {
            input.addEventListener('keypress', handleEnterKey);
        });

        // Add event listener for the "Tambah Baris" button
        document.getElementById('addLineButton').addEventListener('click', addNewLine);

        // Add event listeners for existing delete buttons
        document.querySelectorAll('.delete-line-btn').forEach(button => {
            button.addEventListener('click', function() {
                button.parentElement.remove();
                updateLineNumbers();
            });
        });

        // Update event listener for form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            // Get all input fields
            const tanggal = document.getElementById('tanggal').value;
            const mataKuliahSelect = document.getElementById('mata-kuliah');
            const tempat = document.getElementById('tempat').value;
            const catatanInputs = document.querySelectorAll('#catatanReviewContainer .line-input');

            // Basic validation
            if (!tanggal || !mataKuliahSelect.value || !tempat) {
                event.preventDefault();
                alert('Harap lengkapi semua data sebelum menyimpan.');
                return;
            }

            // Validate catatan
            let isValid = true;
            catatanInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert('Harap isi semua catatan review.');
                return;
            }

            // If all validations pass, form will submit normally
        });

        // Remove the old save-btn event listener if it exists
        document.querySelector('.save-btn').removeEventListener('click', function() {});
    </script>

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
