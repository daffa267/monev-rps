// script.js

// Daftar file dummy untuk ditampilkan pada bagian Data RPS
const files = [
  { no: 1, nama: "RPS_Matematika_Dasar.pdf", tanggal: "2023-01-15" },
  { no: 2, nama: "RPS_Fisika_Lanjutan.pdf", tanggal: "2023-02-20" },
  { no: 3, nama: "RPS_Kimia_Industri.pdf", tanggal: "2023-03-10" },
];

// Fungsi untuk memuat daftar file ke tabel Data RPS
function loadFileList() {
  const fileList = document.getElementById("fileList");
  fileList.innerHTML = ""; // Kosongkan isi tabel terlebih dahulu

  files.forEach((file) => {
    const row = document.createElement("tr");

    // Kolom Nomor
    const noCell = document.createElement("td");
    noCell.textContent = file.no;
    row.appendChild(noCell);

    // Kolom Nama File
    const namaFileCell = document.createElement("td");
    namaFileCell.textContent = file.nama;
    row.appendChild(namaFileCell);

    // Kolom Tanggal Upload
    const tanggalCell = document.createElement("td");
    tanggalCell.textContent = file.tanggal;
    row.appendChild(tanggalCell);

    // Kolom Aksi
    const aksiCell = document.createElement("td");
    aksiCell.classList.add("d-flex", "gap-2");
    // Tombol Lihat
    const lihatButton = document.createElement("button");
    lihatButton.classList.add("btn", "btn-info", "btn-sm", "me-2");
    lihatButton.textContent = "Lihat";
    lihatButton.onclick = () => alert(`Melihat ${file.nama}`);
    aksiCell.appendChild(lihatButton);

    // Tombol Download
    const downloadButton = document.createElement("button");
    downloadButton.classList.add("btn", "btn-primary", "btn-sm", "me-2");
    downloadButton.textContent = "Download";
    downloadButton.onclick = () => alert(`Mengunduh ${file.nama}`);
    aksiCell.appendChild(downloadButton);

    // Tombol Review dengan Modal
    const reviewButton = document.createElement("button");
    reviewButton.classList.add("btn", "btn-warning", "btn-sm");
    reviewButton.textContent = "Review";
    reviewButton.setAttribute("data-toggle", "modal");
    reviewButton.setAttribute("data-target", "#reviewModal");
    reviewButton.onclick = (e) => {
      e.preventDefault();
      // Menyimpan informasi file yang direview
      document.getElementById(
        "reviewModalLabel"
      ).textContent = `Review ${file.nama}`;
      currentFileReview = file;
    };
    aksiCell.appendChild(reviewButton);

    row.appendChild(aksiCell);

    fileList.appendChild(row);
  });
}

// Fungsi untuk menyimpan status Unsur RPS yang dipilih
function saveUnsurStatus() {
  const unsurs = {};
  for (let i = 1; i <= 15; i++) {
    const selected = document.querySelector(`input[name="unsur${i}"]:checked`);
    unsurs[`unsur${i}`] = selected ? selected.value : null;
  }
  console.log("Status Unsur RPS Tersimpan:", unsurs);
}

// Fungsi untuk menambahkan event listener pada pilihan Unsur RPS
function initUnsurRpsListeners() {
  for (let i = 1; i <= 15; i++) {
    const radios = document.getElementsByName(`unsur${i}`);
    radios.forEach((radio) => {
      radio.addEventListener("change", saveUnsurStatus);
    });
  }
}

// Fungsi untuk menjalankan ketika halaman selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
  loadFileList();
  initUnsurRpsListeners();
});
// Sidebar toggle functionality
document
  .querySelector(".toggle-sidebar")
  .addEventListener("click", function () {
    document
      .querySelector(".dashboard-container")
      .classList.toggle("sidebar-collapsed");
  });

// Menangani submit review
document.getElementById("submitReview").addEventListener("click", function () {
  const comment = document.getElementById("reviewComment").value;
  const status = document.getElementById("reviewStatus").value;

  // Di sini Anda bisa menambahkan logika untuk menyimpan review
  console.log("Review submitted:", {
    comment: comment,
    status: status,
    file: currentFileReview,
  });

  // Menutup modal dan mereset form
  $("#reviewModal").modal("hide");
  document.getElementById("reviewForm").reset();

  // Menampilkan notifikasi
  alert("Review berhasil dikirim!");
});
