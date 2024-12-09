<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications'; // Nama tabel notifikasi
    protected $primaryKey = 'notifications_id'; // Nama kolom primary key
    protected $allowedFields = ['user_id', 'message', 'is_read', 'created_at']; // Kolom yang diizinkan untuk diisi
}