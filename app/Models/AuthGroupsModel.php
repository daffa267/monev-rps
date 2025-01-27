<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthGroupsModel extends Model
{
    protected $table = 'auth_groups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
    protected $returnType = 'object';
}
?>