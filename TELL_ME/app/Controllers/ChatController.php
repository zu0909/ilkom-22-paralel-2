<?php

namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    protected $chatModel;

    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }

    // Menampilkan halaman chat
    public function index()
    {
        return view('chat.html'); // Mengarahkan ke halaman chat.html
    }

    // Mengirim pesan
    public function sendMessage()
    {
        $data = [
            'sender_id' => $this->request->getPost('sender_id'),
            'receiver_id' => $this->request->getPost('receiver_id'),
            'message' => $this->request->getPost('message')
        ];

        $this->chatModel->saveMessage($data);
        return $this->response->setJSON(['status' => 'Message Sent']);
    }

    // Mendapatkan pesan antar user
    public function getMessages($sender_id, $receiver_id)
    {
        $messages = $this->chatModel->getMessages($sender_id, $receiver_id);
        return $this->response->setJSON($messages);
    }
}
