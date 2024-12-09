<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CommentModel;


class PostController extends BaseController

{
    public function addComment($postId)
    {
        $commentModel = new CommentModel();

        // Check if the user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        // Get the comment from the form
        $commentData = [
            'post_id' => $postId,
            'user_id' => session()->get('user_id'),
            'content' => $this->request->getPost('content')
        ];

        // Add the comment to the database
        $commentModel->addComment($commentData);

        // Redirect back to the post page
        return redirect()->to('/post/view/' . $postId);
    }

    public function view($postId)
    {
        $postModel = new PostModel();
        $commentModel = new CommentModel();

        // Get the post data
        $post = $postModel->find($postId);

        // Get the comments for this post
        $comments = $commentModel->getComments($postId);

        // Add the comments to the post data
        $post['comments'] = $comments;

        return view('post/view', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
