<?php

namespace App\Controllers;

use App\Models\BapModel;
use App\Models\BapCatatanModel;
use App\Models\MataKuliahModel;

class Dosen extends BaseController
{
  public function getBapDetails($bapId)
  {
    try {
      $bapModel = new BapModel();
      $reviewNotesModel = new BapCatatanModel();
      $mataKuliahModel = new MataKuliahModel();

      $bap = $bapModel->find($bapId);

      if (!$bap) {
        return $this->response->setJSON([
          'success' => false,
          'message' => 'BAP tidak ditemukan'
        ]);
      }

      $mataKuliah = $mataKuliahModel->where('kode_mk', $bap['kode_mk'])->first();

      $reviewNotes = $reviewNotesModel->where('bap_id', $bapId)->findAll();

      return $this->response->setJSON([
        'success' => true,
        'bap' => $bap,
        'nama_mk' => $mataKuliah['nama_mk'],
        'review_notes' => $reviewNotes
      ]);
    } catch (\Exception $e) {
      log_message('error', 'Error in getBapDetails: ' . $e->getMessage());
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan server'
      ]);
    }
  }

  public function updateBap()
  {
    try {
      $json = $this->request->getJSON();
      $bapModel = new BapModel();
      $reviewNotesModel = new BapCatatanModel();

      // Update BAP
      $bapModel->update($json->bap_id, [
        'tanggal' => $json->tanggal,
        'kode_mk' => $json->kode_mk,
        'tempat' => $json->tempat
      ]);

      // Update review notes
      $reviewNotesModel->where('bap_id', $json->bap_id)->delete();
      foreach ($json->catatan as $catatan) {
        $reviewNotesModel->insert([
          'bap_id' => $json->bap_id,
          'catatan' => $catatan
        ]);
      }

      return $this->response->setJSON([
        'success' => true,
        'message' => 'BAP berhasil diperbarui'
      ]);
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

  public function downloadBap($bapId)
  {
    try {
      $bapModel = new BapModel();
      $reviewNotesModel = new BapCatatanModel();
      $mataKuliahModel = new MataKuliahModel();

      $bap = $bapModel->find($bapId);
      if (!$bap) {
        throw new \Exception('BAP tidak ditemukan');
      }

      $mataKuliah = $mataKuliahModel->where('kode_mk', $bap['kode_mk'])->first();
      $reviewNotes = $reviewNotesModel->where('bap_id', $bapId)->findAll();

      // Data hari untuk konversi
      $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
      ];

      // Konfigurasi DOMPDF
      $options = new \Dompdf\Options();
      $options->set('defaultFont', 'times');
      $options->set('isRemoteEnabled', true);
      $options->set('isHtml5ParserEnabled', true);
      $options->set('chroot', FCPATH);
      $options->set('fontCache', FCPATH . 'writable/fonts/');
      $options->set('fontDir', FCPATH . 'writable/fonts/');
      $options->set('isPhpEnabled', true);

      // Inisialisasi DOMPDF
      $dompdf = new \Dompdf\Dompdf($options);

      // Load view dengan data
      $html = view('bap/pdf_template', [
        'bap' => $bap,
        'mata_kuliah' => $mataKuliah,
        'review_notes' => $reviewNotes,
        'hari' => $hari
      ]);

      // Generate PDF
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();

      // Output ke browser
      $filename = 'BAP_' . $bapId . '_' . date('Y-m-d') . '.pdf';

      // Set header untuk download
      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      header('Cache-Control: private, max-age=0, must-revalidate');
      header('Pragma: public');

      echo $dompdf->output();
      exit();
    } catch (\Exception $e) {
      log_message('error', 'Error in downloadBap: ' . $e->getMessage());
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan saat mengunduh BAP: ' . $e->getMessage()
      ]);
    }
  }

  public function deleteBap($bapId)
  {
    try {
      $bapModel = new BapModel();
      $reviewNotesModel = new BapCatatanModel();

      // Delete review notes first (foreign key constraint)
      $reviewNotesModel->where('bap_id', $bapId)->delete();

      // Delete BAP
      $bapModel->delete($bapId);

      return $this->response->setJSON([
        'success' => true,
        'message' => 'BAP berhasil dihapus'
      ]);
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan saat menghapus BAP'
      ]);
    }
  }
}
