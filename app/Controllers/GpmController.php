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
use App\Models\MataKuliahModel;
use App\Models\UnsurModel;
use App\Models\ReviewRpsModel;
use Myth\Auth\Models\GroupModel;
use CodeIgniter\Database\ConnectionInterface;


class GpmController extends BaseController
{
  protected $rpsModel;
  protected $fakultasModel;
  protected $jurusanModel;
  protected $userModel;
  protected $userDetailsModel;
  protected $daftarRpsModel;
  protected $bapCatatanModel;
  protected $bapModel;
  protected $mataKuliahModel;
  protected $unsurModel;
  protected $reviewModel;
  protected $groupModel;
  protected $db;
  public function __construct()
  {
    $this->rpsModel = new RpsModel();
    $this->fakultasModel = new FakultasModel();
    $this->jurusanModel = new JurusanModel();
    $this->userModel = new UserModel();
    $this->userDetailsModel = new UserDetailsModel();
    $this->daftarRpsModel = new DaftarRpsModel();
    $this->bapModel = new BapModel();
    $this->bapCatatanModel = new BapCatatanModel();
    $this->mataKuliahModel = new MataKuliahModel();
    $this->unsurModel = new UnsurModel();
    $this->reviewModel = new ReviewRpsModel();
    $this->groupModel = new GroupModel();
    $this->db = \Config\Database::connect();
  }

  public function dashboard_kajur()
  {
    return view('kajur/dashboard_kajur');
  }

  public function dashboard_gpm()
  {
    return view('gpm/dashboard_gpm');
  }

  public function gpm_rps()
  {
    $data['daftarrps'] = $this->daftarRpsModel->findAll();
    $data['mata_kuliah'] = $this->mataKuliahModel->findAll();
    $data['unsur'] = $this->unsurModel->findAll();
    return view('gpm/gpm', $data);
  }

  public function admin()
  {
    return view('dashboard/dashboard_admin');
  }

  public function kajur()
  {
    return view('dashboard/dashboard_kajur');
  }

  public function download($id)
  {
    $rps = $this->daftarRpsModel->find($id);
    if ($rps) {
      return $this->response->download('path/to/files/' . $rps->link_rps, null);
    } else {
      return redirect()->back()->with('error', 'File not found.');
    }
  }


  // UPDATE
  public function saveReview()
  {
    try {
      $daftarRpsId = $this->request->getPost('daftar_rps_id');
      $statuses = $this->request->getPost('status');
      $catatan = $this->request->getPost('catatan');
      $userId = user()->id;

      // Determine role
      $reviewerRole = in_groups('kajur') ? 'kajur' : (in_groups('gpm') ? 'gpm' : null);

      if (!$reviewerRole) {
        return $this->response->setJSON([
          'success' => false,
          'message' => 'Role tidak valid untuk melakukan review'
        ]);
      }

      // Check if GPM has reviewed (only for Kajur)
      if ($reviewerRole === 'kajur') {
        $gpmReview = $this->reviewModel->where('daftar_rps_id', $daftarRpsId)
          ->where('reviewer_role', 'gpm')
          ->first();
        if (!$gpmReview) {
          return $this->response->setJSON([
            'success' => false,
            'message' => 'RPS harus direview oleh GPM terlebih dahulu'
          ]);
        }
      }

      $overallStatus = 'Sesuai'; // Default status

      foreach ($statuses as $unsurId => $status) {
        $reviewData = [
          'daftar_rps_id' => $daftarRpsId,
          'unsur_id' => $unsurId,
          'reviewer_id' => $userId,
          'reviewer_role' => $reviewerRole,
        ];

        // Set review status based on role
        if ($reviewerRole === 'kajur') {
          $reviewData['review_kajur'] = $status;
          $reviewData['catatan_kajur'] = $catatan[$unsurId] ?? '';
        } else {
          $reviewData['review_gpm'] = $status;
          $reviewData['catatan_gpm'] = $catatan[$unsurId] ?? '';
        }

        // If any status is 'Revisi', set overall status to 'Revisi'
        if ($status === 'Revisi') {
          $overallStatus = 'Revisi';
        }

        // Update final status
        $reviewData['status'] = $overallStatus;

        $existingReview = $this->reviewModel->where([
          'daftar_rps_id' => $daftarRpsId,
          'unsur_id' => $unsurId
        ])->first();

        if ($existingReview) {
          $this->reviewModel->update($existingReview->id, $reviewData);
        } else {
          $this->reviewModel->insert($reviewData);
        }
      }

      return $this->response->setJSON([
        'success' => true,
        'message' => 'Review berhasil disimpan sebagai ' . strtoupper($reviewerRole) .
          ($overallStatus === 'Revisi' ? ' dengan status Revisi' : ' dengan status Sesuai')
      ]);
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

  // UPDATE
  public function checkRpsStatus($rpsId)
  {
    $reviews = $this->reviewModel->where('daftar_rps_id', $rpsId)->findAll();

    $gpmApproved = true;
    $kajurApproved = true;

    foreach ($reviews as $review) {
      if ($review->review_gpm === 'Revisi') {
        $gpmApproved = false;
      }
      if ($review->review_kajur === 'Revisi') {
        $kajurApproved = false;
      }
    }

    if (!$gpmApproved) {
      return 'Perlu Revisi (GPM)';
    } elseif (!$kajurApproved) {
      return 'Perlu Revisi (Kajur)';
    } elseif ($gpmApproved && $kajurApproved) {
      return 'Selesai';
    } else {
      return 'Dalam Proses';
    }
  }

  // VIEW
  public function bap()
  {
    $data['mata_kuliah'] = $this->mataKuliahModel->findAll();

    // Tambahkan query untuk mendapatkan data lengkap
    $query = $this->db->table('bap')
      ->select('bap.*, mata_kuliah.nama_mk')
      ->join('mata_kuliah', 'mata_kuliah.kode_mk = bap.kode_mk')
      ->get();

    $data['bap_list'] = $query->getResultArray();

    // Ambil catatan review untuk setiap BAP
    if (!empty($data['bap_list'])) {
      foreach ($data['bap_list'] as &$bap) {
        $bap['catatan'] = $this->bapCatatanModel
          ->where('bap_id', $bap['id'])
          ->findAll();
      }
    }
    return view('gpm/bap', $data);
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

  public function profile()
  {
    return view('gpm/profile');
  }

  public function notifikasi()
  {
    return view('gpm/notifikasi');
  }
}
