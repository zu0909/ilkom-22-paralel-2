<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\LikeModel;
use App\Models\CommentModel;

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

    public function like($post_id)
    {
        $likeModel = new LikeModel();
        $user_id = session()->get('user_id'); // Pastikan user sudah login

        // Cek apakah user sudah memberikan like pada post tersebut
        $existingLike = $likeModel->where('post_id', $post_id)
                                  ->where('user_id', $user_id)
                                  ->first();

        if ($existingLike) {
            // Jika sudah like, kita bisa menghapus like (unlike)
            $likeModel->delete($existingLike['like_id']);
        } else {
            // Jika belum like, kita simpan like baru
            $likeModel->save([
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);
        }
        return redirect()->to('/');
}
public function comment()
{
    // Get the posted data (the JSON payload from AJAX)
    $data = $this->request->getJSON();
    
    // Ensure the user is logged in and validate the data
    if (!session()->has('user_id') || empty($data->comment_content)) {
        return $this->response->setJSON(['success' => false]);
    }

    // Insert the comment into the database
    $commentModel = new CommentModel();
    $commentModel->save([
        'user_id' => session()->get('user_id'),
        'post_id' => $data->post_id,
        'content' => $data->comment_content,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    // Return success response
    return $this->response->setJSON(['success' => true]);
}

}