<?php

namespace App\Services;

use App\Interfaces\CommentInterface;
use App\Models\Comment;


/**
 * CommentService
 */
class CommentService implements CommentInterface
{

    /**
     * getAllComments
     *
     * @return void
     */
    public function getAllComments()
    {
        return Comment::latest()->get();
    }

    /**
     * getComment
     *
     * @param  mixed $Comment
     * @return void
     */
    public function getComment($Comment)
    {
         $Comment = Comment::find($Comment);

         if($Comment){
            return $Comment;
         }
         return false;
    }

    /**
     * createComment
     *
     * @param  mixed $CommentsDetails
     * @return void
     */
    public function createComment(array $CommentsDetails)
    {
        return Comment::create($CommentsDetails);
    }

    /**
     * updateComment
     *
     * @param  mixed $Comment
     * @param  mixed $CommentDetails
     * @return void
     */
    public function updateComment($Comment, array $CommentDetails)
    {
        return Comment::whereId($Comment)->update($CommentDetails);
    }

    /**
     * deleteComment
     *
     * @param  mixed $Comment
     * @return void
     */
    public function deleteComment($Comment)
    {
        return Comment::destroy($Comment);
    }

    /**
     * userComments
     *
     * @param  mixed $userId
     * @return void
     */
    public function userComments($userId)
    {
        return Comment::where('user_id', $userId)->get();

    }

}
