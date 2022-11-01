<?php

namespace App\Services;

use App\Interfaces\MessageInterface;
use App\Models\Message;


class MessageService implements MessageInterface
{

    public function getAllMessages()
    {
        return Message::latest()->get();
    }

    public function getMessage($Message)
    {
         $Message = Message::find($Message);
         if($Message){
            return $Message;
         }
         return false;
    }

    public function createMessage(array $MessagesDetails)
    {
        return Message::create($MessagesDetails);
    }

    public function updateMessage($Message, array $MessageDetails)
    {
        return Message::whereId($Message)->update($MessageDetails);
    }

    public function deleteMessage($Message)
    {
        return Message::destroy($Message);
    }

    public function userMessages($userId)
    {
        return Message::where('user_id', $userId)->get();

    }

    public function getLatestPost($user_id)
    {
        return Message::where('user_id', $user_id)->lastId();
    }

}
