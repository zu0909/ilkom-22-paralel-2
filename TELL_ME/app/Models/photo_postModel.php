<?php

namespace App\Models;

use CodeIgniter\Model;

class photo_postModel extends Model
{
    protected $table = 'photo_post';
    protected $primary = 'image_id';
    protected $allowedFields =['image_size', 'caption'];
}