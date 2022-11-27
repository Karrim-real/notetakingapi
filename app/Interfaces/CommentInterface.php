<?php
namespace App\Interfaces;

interface CommentInterface
{
    /**
     * getAllComments
     *
     * @return void
     */
    public function getAllComments();

    /**
     * createComment
     *
     * @param  mixed $CommentsDetails
     * @return void
     */
    public function createComment(array $CommentsDetails);

    /**
     * getComment
     *
     * @param  mixed $Comment
     * @return void
     */
    public function getComment(int $Comment);

    /**
     * updateComment
     *
     * @param  mixed $Comment
     * @param  mixed $CommentDetails
     * @return void
     */
    public function updateComment(int $Comment, array $CommentDetails);

    /**
     * deleteComment
     *
     * @param  mixed $Comment
     * @return void
     */
    public function deleteComment(int $Comment);

    /**
     * userComments
     *
     * @param  mixed $userId
     * @return void
     */
    public function userComments($userId);


}
