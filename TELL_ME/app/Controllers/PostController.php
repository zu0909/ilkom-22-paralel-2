<?php

namespace App\Controllers;

use App\Models\PostModel;

class PostController extends BaseController
{ 
    public function create()
    {
        $userId = session()->get('user_id');

        $postText = $this->request->getPost('post_text');
        
        // Validasi input
        if (empty($postText)) {
            return redirect()->back()->with('error', 'Post text cannot be empty');
        }

        // Simpan post ke database
        $model = new PostModel();
        $data = [
            'user_id' => $userId,  // ID pengguna yang sedang login
            'content' => $postText,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/')->with('message', 'Post created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create post');
        }
    }
}
