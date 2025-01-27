<?php

namespace App\Controllers;

use App\Models\RpsModel;
use App\Models\FakultasModel;
use App\Models\JurusanModel;
use Myth\Auth\Models\UserModel;
use App\Models\UserDetailsModel;
use App\Models\DaftarRpsModel;
use App\Models\BapCatatanModel;
use App\Models\BapModel;
use App\Models\UnsurModel;
use App\Models\ReviewRpsModel;
use App\Models\MataKuliahModel;

class dosenController extends BaseController
{
  protected $rpsModel;
  protected $fakultas;
  protected $jurusan;
  protected $user;
  protected $userdetail;
  protected $db;
  protected $daftarRps;
  protected $BapCatatan;
  protected $Bap;
  protected $unsurModel;
  protected $reviewModel;
  protected $mataKuliahModel;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->rpsModel = new RPSModel();
    $this->fakultas = new FakultasModel();
    $this->jurusan = new JurusanModel();
    $this->user = new UserModel();
    $this->userdetail = new UserDetailsModel();
    $this->daftarRps = new DaftarRpsModel();
    $this->Bap = new BapModel();
    $this->BapCatatan = new BapCatatanModel();
    $this->unsurModel = new UnsurModel();
    $this->reviewModel = new ReviewRpsModel();
    $this->mataKuliahModel = new MataKuliahModel();
  }

  public function dosen()
  {
    return view('dosen/Dashboard_Dosen');
  }

  public function unggah_rps()
  {
    // Get data for dropdowns
    $data['prodi'] = $this->jurusan->findAll(); // Get full jurusan data
    $data['tahun_ajaran'] = $this->getTahunAjaran();
    $data['rps'] = $this->getRpsData();

    // Get mata kuliah data grouped by jurusan and convert to array
    $mataKuliahQuery = $this->db->table('mata_kuliah')
      ->select('mata_kuliah.kode_mk, mata_kuliah.nama_mk, mata_kuliah.id_jurusan')
      ->join('jurusan', 'jurusan.id = mata_kuliah.id_jurusan')
      ->get();

    $data['mata_kuliah'] = $mataKuliahQuery ? $mataKuliahQuery->getResultArray() : [];

    // Convert prodi to array if it's not already
    $data['prodi'] = array_map(function ($item) {
      return is_object($item) ? (array)$item : $item;
    }, $data['prodi']);

    return view('dosen/unggah-rps', $data);
  }

  private function getTahunAjaran()
  {
    $currentYear = date('Y');
    $years = [];
    for ($i = 0; $i < 5; $i++) {
      $years[] = ($currentYear - $i) . '/' . ($currentYear - $i + 1);
    }
    return $years;
  }

  private function getRpsData()
  {
    // Initialize empty data structure
    return [
      [
        'mata_kuliah' => '',
        'kode_mata_kuliah' => '',
        'prodi' => '',
        'tahun_ajaran' => '',
        'semester' => '',
        'kelas' => ''
      ]
    ];
  }

  public function daftar_upload()
  {
    // Get current user ID
    $userId = user_id();

    // Get search parameters
    $searchMataKuliah = $this->request->getGet('mata_kuliah');
    $searchProdi = $this->request->getGet('prodi');

    // Get data for dropdowns
    $data['prodi'] = $this->jurusan->findAll();
    $data['mata_kuliah'] = $this->db->table('mata_kuliah')
      ->select('mata_kuliah.*, jurusan.nama_jurusan')
      ->join('jurusan', 'jurusan.id = mata_kuliah.id_jurusan')
      ->get()->getResult();

    // Build base query for RPS list
    $query = $this->db->table('daftar_rps')
      ->select('daftar_rps.*, mata_kuliah.nama_mk, jurusan.nama_jurusan')
      ->join('mata_kuliah', 'mata_kuliah.kode_mk = daftar_rps.kode_mk')
      ->join('jurusan', 'jurusan.id = daftar_rps.jurusan_id')
      ->where('daftar_rps.user_id', $userId);

    // Apply search filters if they exist
    if ($searchMataKuliah) {
      $query->where('daftar_rps.kode_mk', $searchMataKuliah);
    }
    if ($searchProdi) {
      $query->where('daftar_rps.jurusan_id', $searchProdi);
    }

    // Execute query and get results
    $data['rps_list'] = $query->get()->getResult();

    // Add search parameters to data array for maintaining form state
    $data['search_mata_kuliah'] = $searchMataKuliah;
    $data['search_prodi'] = $searchProdi;

    return view('dosen/daftar_upload', $data);
  }

  public function link_rps()
  {
    return view('dosen/linkRPS');
  }

  public function bap()
  {

    $userId = user_id();

    $mataKuliahQuery = $this->db->table('mata_kuliah')
      ->select('mata_kuliah.kode_mk, mata_kuliah.nama_mk')
      ->get();

    $data['mata_kuliah'] = $mataKuliahQuery->getResultArray();

    return view('dosen/isi-bap', $data);
  }

  public function daftar_bap()
  {
    $userId = user_id();

    $query = $this->db->table('bap')
      ->select('bap.*, mata_kuliah.nama_mk, bap.id as bap_id')
      ->join('mata_kuliah', 'mata_kuliah.kode_mk = bap.kode_mk')
      ->where('bap.user_id', $userId)
      ->orderBy('bap.tanggal', 'DESC');

    $data['bap_list'] = $query->get()->getResultArray();

    if (!empty($data['bap_list'])) {
      foreach ($data['bap_list'] as &$bap) {
        $bap['catatan'] = $this->db->table('bap_catatan')
          ->where('bap_id', $bap['bap_id'])
          ->orderBy('urutan', 'ASC')
          ->get()
          ->getResultArray();
      }
    }

    return view('dosen/daftar_bap', $data);
  }

  public function feedback()
  {
    // Ambil ID dosen yang sedang login
    $dosenId = user_id();

    // Ambil daftar RPS dengan informasi lengkap
    $data['daftar_rps'] = $this->db->table('daftar_rps')
      ->select('daftar_rps.*, mata_kuliah.nama_mk, jurusan.nama_jurusan')
      ->join('mata_kuliah', 'mata_kuliah.kode_mk = daftar_rps.kode_mk')
      ->join('jurusan', 'jurusan.id = daftar_rps.jurusan_id')
      ->where('daftar_rps.user_id', $dosenId)
      ->get()
      ->getResult();

    // Ambil ID RPS yang dipilih dari query parameter
    $selectedRpsId = $this->request->getGet('rps_id');

    if ($selectedRpsId) {
      // Ambil semua unsur RPS
      $data['unsur_rps'] = $this->unsurModel->findAll();

      // Gunakan ReviewRpsModel untuk mengambil review dengan catatan
      $reviewModel = new \App\Models\ReviewRpsModel();
      $reviews = $reviewModel->where('daftar_rps_id', $selectedRpsId)->findAll();

      // Reorganisasi reviews berdasarkan unsur_id dengan tambahan penanganan catatan
      $data['reviews'] = [];
      foreach ($reviews as $review) {
        $data['reviews'][$review->unsur_id] = $review;
      }

      $data['selected_rps_id'] = $selectedRpsId;
    }

    return view('dosen/feedback', $data);
  }

  public function getMataKuliahByJurusan($jurusanId)
  {
    $mataKuliahQuery = $this->db->table('mata_kuliah')
      ->select('kode_mk, nama_mk')
      ->where('id_jurusan', $jurusanId)
      ->get();

    $mataKuliah = $mataKuliahQuery ? $mataKuliahQuery->getResultArray() : [];

    return $this->response->setJSON($mataKuliah);
  }


  //CREATE
  public function simpan_rps()
  {
    if (!$this->validate([
      'kode_mk' => 'required',
      'jurusan_id' => 'required',
      'kelas' => 'required',
      'link_rps' => 'required|valid_url'
    ])) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'user_id' => user_id(),
      'kode_mk' => $this->request->getPost('kode_mk'),
      'jurusan_id' => $this->request->getPost('jurusan_id'),
      'kelas' => $this->request->getPost('kelas'),
      'link_rps' => $this->request->getPost('link_rps')
    ];

    if ($this->daftarRps->save($data)) {
      return redirect()->to('dosen/daftar_upload')->with('message', 'RPS berhasil disimpan');
    }

    return redirect()->back()->withInput()->with('error', 'Gagal menyimpan RPS');
  }

  //DELETE
  public function hapus_rps($id)
  {
    $userId = user_id();
    $existingRps = $this->daftarRps->where('id', $id)
      ->where('user_id', $userId)
      ->first();

    if (!$existingRps) {
      return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
    }

    if ($this->daftarRps->delete($id)) {
      return $this->response->setJSON(['success' => true]);
    }
    return $this->response->setJSON(['success' => false]);
  }

  // READ
  public function get_rps($id)
  {
    $userId = user_id();
    $rps = $this->daftarRps->where('id', $id)
      ->where('user_id', $userId)
      ->first();

    if (!$rps) {
      return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
    }

    return $this->response->setJSON($rps);
  }

  //UPDATE
  public function update_rps($id)
  {
    // Ambil raw input JSON
    $jsonInput = $this->request->getJSON(true);

    if (empty($jsonInput)) {
      return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid']);
    }

    // Validasi input
    $rules = [
      'kode_mk' => 'required',
      'jurusan_id' => 'required',
      'kelas' => 'required',
      'link_rps' => 'required|valid_url'
    ];

    if (!$this->validateData($jsonInput, $rules)) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Validasi gagal',
        'errors' => $this->validator->getErrors()
      ]);
    }

    $userId = user_id();
    $existingRps = $this->daftarRps->where('id', $id)
      ->where('user_id', $userId)
      ->first();

    if (!$existingRps) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Data RPS tidak ditemukan'
      ]);
    }

    try {
      $data = [
        'kode_mk' => $jsonInput['kode_mk'],
        'jurusan_id' => $jsonInput['jurusan_id'],
        'kelas' => $jsonInput['kelas'],
        'link_rps' => $jsonInput['link_rps'],
        'updated_at' => date('Y-m-d H:i:s')
      ];

      $updated = $this->daftarRps->update($id, $data);

      if ($updated) {
        return $this->response->setJSON([
          'success' => true,
          'message' => 'RPS berhasil diperbarui'
        ]);
      } else {
        return $this->response->setJSON([
          'success' => false,
          'message' => 'Gagal memperbarui RPS'
        ]);
      }
    } catch (\Exception $e) {
      log_message('error', 'Error updating RPS: ' . $e->getMessage());
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan saat memperbarui RPS'
      ]);
    }
  }

  public function simpan_bap()
  {
    if (!$this->validate([
      'tanggal' => 'required',
      'kode_mk' => 'required',
      'tempat' => 'required',
      'catatan' => 'required',
      'catatan.*' => 'required'
    ])) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $this->db->transStart();

    try {
      // Simpan data BAP utama
      $bapData = [
        'user_id' => user_id(),
        'tanggal' => $this->request->getPost('tanggal'),
        'kode_mk' => $this->request->getPost('kode_mk'),
        'tempat' => $this->request->getPost('tempat')
      ];

      $this->Bap->insert($bapData);
      $bapId = $this->Bap->insertID();

      // Simpan catatan review
      $catatan = $this->request->getPost('catatan');
      foreach ($catatan as $index => $isi_catatan) {
        $this->BapCatatan->insert([
          'bap_id' => $bapId,
          'catatan' => $isi_catatan,
          'urutan' => $index + 1
        ]);
      }

      $this->db->transCommit();
      return redirect()->to('dosen/daftar_bap')->with('message', 'BAP berhasil disimpan');
    } catch (\Exception $e) {
      $this->db->transRollback();
      log_message('error', $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Gagal menyimpan BAP: ' . $e->getMessage());
    }
  }

  public function profile_dosen()
  {
    return view('dosen/profile');
  }

  public function notifikasi_rps()
  {
    return view('dosen/notifikasi-rps');
  }

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
