// Contoh data BAP
const dataBAP = [
    {
        no: 1,
        tanggal: "2024-12-01",
        mataKuliah: "Pemrograman Web",
        kodeMK: "PW123",
        tempat: "Lab Komputer"
    },
    {
        no: 2,
        tanggal: "2024-12-05",
        mataKuliah: "Jaringan Komputer",
        kodeMK: "JK456",
        tempat: "Ruang 202"
    },
    {
        no: 3,
        tanggal: "2024-12-08",
        mataKuliah: "Basis Data",
        kodeMK: "BD789",
        tempat: "Lab Database"
    }
];

// Fungsi untuk menambahkan baris data ke tabel
function isiTabelBAP() {
    const tbody = document.querySelector("#daftarBapTable tbody");
    dataBAP.forEach((item) => {
        const tr = document.createElement("tr");

        tr.innerHTML = `
            <td>${item.no}</td>
            <td>${item.tanggal}</td>
            <td>${item.mataKuliah}</td>
            <td>${item.kodeMK}</td>
            <td>${item.tempat}</td>
            <td>
                <button class="btn btn-primary btn-sm button-spacing" data-bs-toggle="tooltip" title="Lihat">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-success btn-sm button-spacing" data-bs-toggle="tooltip" title="Download">
                    <i class="bi bi-download"></i>
                </button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Review">
                    <i class="bi bi-pencil"></i>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });
}

// Panggil fungsi isiTabelBAP saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
    isiTabelBAP();

    // Inisialisasi tooltip untuk elemen baru
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
