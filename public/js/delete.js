function confirmDelete(link) {
  if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
    // Jika pengguna mengklik "OK", lanjutkan ke URL penghapusan
    return true;
  } else {
    // Jika pengguna mengklik "Batal", hentikan tindakan default tautan
    return false;
  }
}
