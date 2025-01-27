// public/js/fakultas-jurusan.js

document.addEventListener("DOMContentLoaded", function () {
  // Data jurusan berdasarkan fakultas yang diteruskan dari PHP
  var jurusanByFakultas = JSON.parse(
    document.getElementById("jurusanData").textContent
  );

  // Menunggu perubahan pada dropdown fakultas
  document
    .getElementById("fakultas_id")
    .addEventListener("change", function () {
      var fakultasId = this.value;
      var jurusanSelect = document.getElementById("jurusan_id");

      // Reset dropdown jurusan
      jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';

      // Menampilkan jurusan yang sesuai dengan fakultas yang dipilih
      if (fakultasId && jurusanByFakultas[fakultasId]) {
        var jurusanOptions = jurusanByFakultas[fakultasId];
        jurusanOptions.forEach(function (jurusan) {
          var option = document.createElement("option");
          option.value = jurusan.id;
          option.textContent = jurusan.nama_jurusan;
          jurusanSelect.appendChild(option);
        });
      }
    });

  // Menjalankan fungsi untuk memastikan jurusan yang sesuai tampil pada awalnya
  document.getElementById("fakultas_id").dispatchEvent(new Event("change"));
});
