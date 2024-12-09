<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'like_id';
    protected $allowedFields = ['post_id', 'user_id', 'created_at', ];
    protected $useTimestamps = true;
}
