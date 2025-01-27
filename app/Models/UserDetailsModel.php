<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDetailsModel extends Model
{
    protected $table = 'users_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama', 'nidn', 'fakultas_id', 'jurusan_id'];
    protected $returnType = 'object';
}
?>