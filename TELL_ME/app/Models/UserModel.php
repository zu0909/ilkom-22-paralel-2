<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primary = 'user_id';
    protected $allowedFields =['username', 'email', 'password', 'bio', 'profile_picture', 'followers'];
}