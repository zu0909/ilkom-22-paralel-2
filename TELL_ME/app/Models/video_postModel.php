<?php

namespace App\Models;

use CodeIgniter\Model;

class video_postModel extends Model
{
    protected $table = 'video_post';
    protected $primary = 'video_id';
    protected $allowedFields =['video_size', 'caption'];
}