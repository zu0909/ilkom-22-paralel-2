<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sender_id', 'receiver_id', 'message'];
    protected $useTimestamps = true;

    // Menyimpan pesan baru ke database
    public function saveMessage($data)
    {
        return $this->insert($data);
    }

    // Mendapatkan pesan berdasarkan sender dan receiver
    public function getMessages($sender_id, $receiver_id)
    {
        return $this->where("(sender_id = $sender_id AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = $sender_id)")
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
}
