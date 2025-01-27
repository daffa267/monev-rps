<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewRpsModel extends Model
{
  protected $table            = 'review_rps';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'object';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'daftar_rps_id',
    'unsur_id',
    'status',
    'catatan',
    'catatan_gpm',
    'catatan_kajur',
    'review_gpm',
    'review_kajur',
    'reviewer_role',
    'reviewer_id'


  ];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  // Validation
  protected $validationRules = [
    'daftar_rps_id' => 'required|numeric',
    'unsur_id'      => 'required|numeric',
    'status'        => 'required|in_list[Belum diperiksa,Sesuai,Revisi]',
  ];

  protected $validationMessages = [
    'daftar_rps_id' => [
      'required' => 'ID RPS harus diisi',
      'numeric'  => 'ID RPS harus berupa angka'
    ],
    'unsur_id' => [
      'required' => 'ID Unsur harus diisi',
      'numeric'  => 'ID Unsur harus berupa angka'
    ],
    'status' => [
      'required'  => 'Status harus diisi',
      'in_list'   => 'Status harus salah satu dari: Belum diperiksa, Sesuai, atau Revisi'
    ]
  ];

  protected $skipValidation = false;

  // Relationships
  public function daftarRps()
  {
    return $this->belongsTo('App\Models\DaftarRpsModel', 'daftar_rps_id', 'id');
  }

  public function unsurRps()
  {
    return $this->belongsTo('App\Models\UnsurModel', 'unsur_id', 'id_unsur');
  }

  // Custom Methods
  public function getReviewByRpsId($rpsId)
  {
    return $this->where('daftar_rps_id', $rpsId)->findAll();
  }

  public function getReviewByUnsurAndRps($unsurId, $rpsId)
  {
    return $this->where([
      'unsur_id' => $unsurId,
      'daftar_rps_id' => $rpsId
    ])->first();
  }

  public function updateOrCreateReview($data)
  {
    $existingReview = $this->getReviewByUnsurAndRps($data['unsur_id'], $data['daftar_rps_id']);

    if ($existingReview) {
      return $this->update($existingReview->id, $data);
    }

    return $this->insert($data);
  }

  public function getDetailedReview($rpsId)
  {
    $db = \Config\Database::connect();

    return $db->table($this->table)
      ->select('review_rps.*, unsur_rps.unsur, daftar_rps.catatan_kajur, daftar_rps.catatan_gpm')
      ->join('unsur_rps', 'unsur_rps.id_unsur = review_rps.unsur_id')
      ->join('daftar_rps', 'daftar_rps.id = review_rps.daftar_rps_id')
      ->where('review_rps.daftar_rps_id', $rpsId)
      ->get()
      ->getResult();
  }

  public function deleteReviewsByRpsId($rpsId)
  {
    return $this->where('daftar_rps_id', $rpsId)->delete();
  }
}
