<?php

namespace App\Services;

use App\Interfaces\CommentInterface;
use App\Models\Comment;


class CommentService implements CommentInterface
{

    public function getAllComments()
    {
        return Comment::latest()->get();
    }

    public function getComment($Comment)
    {
         $Comment = Comment::find($Comment);

         if($Comment){
            return $Comment;
         }
         return false;
    }

    public function createComment(array $CommentsDetails)
    {
        return Comment::create($CommentsDetails);
    }

    public function updateComment($Comment, array $CommentDetails)
    {
        return Comment::whereId($Comment)->update($CommentDetails);
    }

    public function deleteComment($Comment)
    {
        return Comment::destroy($Comment);
    }

    public function userComments($userId)
    {
        return Comment::where('user_id', $userId)->get();

    }

}
