<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table      = 'posts';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['user_id', 'content', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
