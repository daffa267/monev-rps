<?php

namespace App\Models;

use CodeIgniter\Model;

class BapCatatanModel extends Model
{
  protected $table = 'bap_catatan';
  protected $primaryKey = 'id';
  protected $allowedFields = ['bap_id', 'catatan', 'urutan'];
}
