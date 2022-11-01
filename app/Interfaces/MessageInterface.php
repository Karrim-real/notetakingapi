<?php
namespace App\Interfaces;

interface MessageInterface
{
    public function getAllMessages();

    public function createMessage(array $MessagesDetails);

    public function getMessage(int $Message);

    public function updateMessage(int $Message, array $MessageDetails);

    public function deleteMessage(int $Message);

    public function userMessages($userId);


}
