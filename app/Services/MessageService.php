<?php

namespace App\Services;

use App\Interfaces\MessageInterface;
use App\Models\Message;


/**
 * MessageService
 */
class MessageService implements MessageInterface
{

    /**
     * getAllMessages
     *
     * @return void
     */
    public function getAllMessages()
    {
        return Message::latest()->get();
    }

    /**
     * getMessage
     *
     * @param  mixed $Message
     * @return void
     */
    public function getMessage($Message)
    {
         $Message = Message::find($Message);
         if($Message){
            return $Message;
         }
         return false;
    }

    /**
     * createMessage
     *
     * @param  mixed $MessagesDetails
     * @return void
     */
    public function createMessage(array $MessagesDetails)
    {
        return Message::create($MessagesDetails);
    }

    /**
     * updateMessage
     *
     * @param  mixed $Message
     * @param  mixed $MessageDetails
     * @return void
     */
    public function updateMessage($Message, array $MessageDetails)
    {
        return Message::whereId($Message)->update($MessageDetails);
    }

    /**
     * deleteMessage
     *
     * @param  mixed $Message
     * @return void
     */
    public function deleteMessage($Message)
    {
        return Message::destroy($Message);
    }

    /**
     * userMessages
     *
     * @param  mixed $userId
     * @return void
     */
    public function userMessages($userId)
    {
        return Message::where('user_id', $userId)->get();

    }

    /**
     * getLatestPost
     *
     * @param  mixed $user_id
     * @return void
     */
    public function getLatestPost($user_id)
    {
        return Message::where('user_id', $user_id)->lastId();
    }

}
