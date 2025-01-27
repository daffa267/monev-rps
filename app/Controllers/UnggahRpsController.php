<?php

namespace App\Controllers;

use App\Models\RpsModel;
use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;

class UnggahRpsController extends Controller
{

  // CREATE
  public function simpan_rps()
  {
    $rpsModel = new RpsModel();
    $userModel = new UserModel();

    // Mendapatkan user_id dari sesi pengguna yang aktif
    $userId = user_id();

    // Pastikan user_id valid
    $user = $userModel->find($userId);
    if (!$user) {
      return redirect()->back()->withInput()->with('error', 'Pengguna tidak ditemukan.');
    }

    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
      'mataKuliah' => 'required',
      'kode' => 'required',
      'prodi' => 'required',
      'tahun' => 'required',
      'semester' => 'required',
      'kelas' => 'required',
      'rpsLink' => 'required|valid_url',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
      return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Ambil data dari request
    $data = [
      'kode_mk' => $this->request->getPost('kode'),
      'tahun_ajaran' => $this->request->getPost('tahun'),
      'semester' => $this->request->getPost('semester'),
      'kelas' => $this->request->getPost('kelas'),
      'link_rps' => $this->request->getPost('rpsLink'),
      'jurusan_id' => $this->request->getPost('prodi'),
      'user_id' => $userId,  // Menggunakan user_id yang valid
    ];

    // Simpan ke database
    if ($rpsModel->insert($data)) {
      return redirect()->to(base_url('dosen//daftar_upload'))->with('success', 'RPS berhasil diunggah.');
    } else {
      return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
  }
}
