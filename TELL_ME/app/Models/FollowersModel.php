<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowersModel extends Model
{
    protected $table = 'followers'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'follower_id']; // Kolom yang dapat diisi

    // Tambahkan metode custom sesuai kebutuhan
}
