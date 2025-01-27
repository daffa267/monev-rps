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
      <a href="/dosen/notifikasi_rps" class="menu-item">
        <i class="bi bi-bell-fill"></i><span>Notifikasi</span>
      </a>
      <a href="/logout" class="menu-item">
        <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
      </a>
    </nav>

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
        <h1 class="h4">Home / Daftar Upload RPS</h1>
      </header>
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="input-group input-group-container">
            <select class="form-select" id="searchMataKuliah" aria-label="Select Mata Kuliah">
              <option selected value="">Pilih Mata Kuliah</option>
              <?php foreach ($mata_kuliah as $mk): ?>
                <option value="<?= $mk->kode_mk ?>"><?= $mk->nama_mk ?></option>
              <?php endforeach; ?>
            </select>
            <select class="form-select" id="searchProdi" aria-label="Select Prodi">
              <option selected value="">Pilih Prodi</option>
              <?php foreach ($prodi as $p): ?>
                <option value="<?= $p->id ?>"><?= $p->nama_jurusan ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-outline-secondary custom-btn" id="searchButton">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>

        <div class="container mt-5">
          <div class="table-container">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Prodi</th>
                    <th>Kelas</th>
                    <th>Tanggal Upload</th>
                    <th>Link RPS</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="rpsListBody">
                  <?php if (!empty($rps_list)): ?>
                    <?php foreach ($rps_list as $index => $rps): ?>
                      <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($rps->nama_mk) ?></td>
                        <td><?= esc($rps->kode_mk) ?></td>
                        <td><?= esc($rps->nama_jurusan) ?></td>
                        <td><?= esc($rps->kelas) ?></td>
                        <td><?= date('d-m-Y', strtotime($rps->created_at)) ?></td>
                        <td>
                          <?php if (!empty($rps->link_rps)): ?>
                            <a href="<?= esc($rps->link_rps) ?>" target="_blank">
                              <i class="bi bi-eye-fill"></i>
                            </a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <i class="bi bi-pencil-square edit-icon"
                            data-id="<?= $rps->id ?>"
                            data-bs-toggle="tooltip"
                            title="Edit"
                            style="cursor: pointer;"></i>

                          <i class="bi bi-trash3-fill delete-icon"
                            data-id="<?= $rps->id ?>"
                            style="cursor: pointer; margin-left: 10px;"
                            data-bs-toggle="tooltip"
                            title="Hapus"></i>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center">Tidak ada data RPS</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <a href="<?= base_url('dosen/unggah-rps') ?>" class="btn btn-primary mt-3">Unggah RPS Baru</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit RPS</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <div class="mb-3">
                <label for="editProdi" class="form-label">Program Studi</label>
                <select class="form-control" id="editProdi" required>
                  <option value="">Pilih Program Studi</option>
                  <?php foreach ($prodi as $p): ?>
                    <option value="<?= $p->id ?>"><?= $p->nama_jurusan ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="editMataKuliah" class="form-label">Mata Kuliah</label>
                <select class="form-control" id="editMataKuliah" required>
                  <option value="">Pilih Mata Kuliah</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="editKelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="editKelas" required>
              </div>
              <div class="mb-3">
                <label for="editLinkRps" class="form-label">Link RPS</label>
                <input type="url" class="form-control" id="editLinkRps" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="saveEditBtn">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel">Unggah RPS Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('dosen/simpan_rps') ?>" method="post">
            <div class="modal-body">
              <div class="mb-3">
                <label for="kode_mk" class="form-label">Mata Kuliah</label>
                <select class="form-select" id="kode_mk" name="kode_mk" required>
                  <option value="">Pilih Mata Kuliah</option>
                  <?php foreach ($mata_kuliah as $mk): ?>
                    <option value="<?= $mk->kode_mk ?>"><?= $mk->nama_mk ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="jurusan_id" class="form-label">Program Studi</label>
                <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                  <option value="">Pilih Program Studi</option>
                  <?php foreach ($prodi as $p): ?>
                    <option value="<?= $p->id ?>"><?= $p->nama_jurusan ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required>
              </div>
              <div class="mb-3">
                <label for="link_rps" class="form-label">Link RPS</label>
                <input type="url" class="form-control" id="link_rps" name="link_rps" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
  </footer>

  <script src="/js/dosen.js"></script>
  <!-- Scripts for Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Set nilai dropdown sesuai parameter URL saat halaman dimuat
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('mata_kuliah')) {
        document.getElementById('searchMataKuliah').value = urlParams.get('mata_kuliah');
      }
      if (urlParams.has('prodi')) {
        document.getElementById('searchProdi').value = urlParams.get('prodi');
      }

      // Handle search functionality
      document.getElementById('searchButton').addEventListener('click', function() {
        const mataKuliah = document.getElementById('searchMataKuliah').value;
        const prodi = document.getElementById('searchProdi').value;

        // Buat URL dengan parameter pencarian
        const searchParams = new URLSearchParams();
        if (mataKuliah) searchParams.append('mata_kuliah', mataKuliah);
        if (prodi) searchParams.append('prodi', prodi);

        // Redirect ke halaman yang sama dengan parameter pencarian
        window.location.href = `${window.location.pathname}?${searchParams.toString()}`;
      });

      // Tambahkan event listener untuk tombol Enter pada dropdown
      document.getElementById('searchMataKuliah').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          document.getElementById('searchButton').click();
        }
      });

      document.getElementById('searchProdi').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          document.getElementById('searchButton').click();
        }
      });

      // Handle prodi change to update mata kuliah dropdown
      document.getElementById('editProdi').addEventListener('change', function() {
        const prodiId = this.value;
        const mataKuliahSelect = document.getElementById('editMataKuliah');

        // Clear current options
        mataKuliahSelect.innerHTML = '<option value="">Pilih Mata Kuliah</option>';

        if (prodiId) {
          fetch(`/dosen/getMataKuliahByJurusan/${prodiId}`)
            .then(response => response.json())
            .then(data => {
              data.forEach(mk => {
                const option = document.createElement('option');
                option.value = mk.kode_mk;
                option.textContent = mk.nama_mk;
                mataKuliahSelect.appendChild(option);
              });
            })
            .catch(error => console.error('Error:', error));
        }
      });

      // Handle Edit
      document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function() {
          const rpsId = this.dataset.id;

          // Fetch RPS data
          fetch(`/dosen/get_rps/${rpsId}`)
            .then(response => response.json())
            .then(data => {
              if (data.error) {
                alert(data.error);
                return;
              }

              // Set prodi value first
              document.getElementById('editProdi').value = data.jurusan_id;

              // Trigger prodi change event to load mata kuliah options
              const event = new Event('change');
              document.getElementById('editProdi').dispatchEvent(event);

              // Set other values after a short delay to ensure mata kuliah options are loaded
              setTimeout(() => {
                document.getElementById('editMataKuliah').value = data.kode_mk;
                document.getElementById('editKelas').value = data.kelas;
                document.getElementById('editLinkRps').value = data.link_rps;

                // Store RPS ID for update
                document.getElementById('editForm').dataset.rpsId = rpsId;

                // Show modal
                new bootstrap.Modal(document.getElementById('editModal')).show();
              }, 500);
            })
            .catch(error => console.error('Error:', error));
        });
      });

      // Handle Save Edit
      document.getElementById('saveEditBtn').addEventListener('click', function() {
        const rpsId = document.getElementById('editForm').dataset.rpsId;
        const formData = {
          kode_mk: document.getElementById('editMataKuliah').value,
          jurusan_id: document.getElementById('editProdi').value,
          kelas: document.getElementById('editKelas').value,
          link_rps: document.getElementById('editLinkRps').value
        };

        // Tambahkan log untuk debugging
        console.log('Sending data:', formData);

        fetch(`/dosen/update_rps/${rpsId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message || 'RPS berhasil diperbarui');
              window.location.reload();
            } else {
              alert(data.message || 'Gagal mengupdate RPS');
              console.error('Error details:', data);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan RPS');
          });
      });

      // Handle Delete
      document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function() {
          if (confirm('Apakah Anda yakin ingin menghapus RPS ini?')) {
            const rpsId = this.dataset.id;

            fetch(`/dosen/hapus_rps/${rpsId}`, {
                method: 'DELETE',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest'
                }
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  window.location.reload();
                } else {
                  alert('Gagal menghapus RPS');
                }
              })
              .catch(error => console.error('Error:', error));
          }
        });
      });
    });
  </script>
</body>

</html>