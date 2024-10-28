<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primary = 'id';
    protected $allowedFields =['username', 'email', 'password'];
}