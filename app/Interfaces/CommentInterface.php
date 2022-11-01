<?php
namespace App\Interfaces;

interface CommentInterface
{
    public function getAllComments();

    public function createComment(array $CommentsDetails);

    public function getComment(int $Comment);

    public function updateComment(int $Comment, array $CommentDetails);

    public function deleteComment(int $Comment);

    public function userComments($userId);


}
