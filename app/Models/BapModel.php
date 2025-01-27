<?php

namespace App\Models;

use CodeIgniter\Model;

class BapModel extends Model
{
  protected $table = 'bap';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'tanggal', 'kode_mk', 'tempat'];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
}
