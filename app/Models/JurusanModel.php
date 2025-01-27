<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jurusan', 'fakultas_id'];
    protected $returnType = 'object';

    public function getNamaJurusan($id)
    {
        $result = $this->find($id);
        return $result ? $result['nama_jurusan'] : null;
    }
}
