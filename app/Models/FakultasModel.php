<?php

namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_fakultas', 'keterangan'];
    protected $returnType = 'object';
}
?>