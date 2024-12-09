<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'comments';
    protected $primaryKey = 'comment_id';
    protected $allowedFields = ['post_id', 'user_id', 'content', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getComments($postId)
{
    return $this->select('comments.*, user.username') // Select fields from comments and the username
                ->join('user', 'user.user_id = comments.user_id') // Join user table on user_id
                ->where('comments.post_id', $postId) // Filter by post_id
                ->findAll(); // Return all comments for the post
    {
        return $this->save($data);
    }
}}
