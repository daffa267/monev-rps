<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType       = 'object';
    protected $allowedFields = ['username', 'email'];

    public function getUserWithRole()
    {
        return $this->select('users.id, users.username, users.email, users_details.nama, users_details.nidn, fakultas.nama_fakultas AS fakultas, jurusan.nama_jurusan AS jurusan, auth_groups.name AS role, auth_groups.description')
                    ->join('users_details', 'users.id = users_details.user_id', 'left')
                    ->join('fakultas', 'users_details.fakultas_id = fakultas.id', 'left')
                    ->join('jurusan', 'users_details.jurusan_id = jurusan.id', 'left')
                    ->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'left')
                    ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id', 'left')
                    ->findAll();

    }
}
