<?php
namespace App\Interfaces;

interface MessageInterface
{
    /**
     * getAllMessages
     *
     * @return void
     */
    public function getAllMessages();

    /**
     * createMessage
     *
     * @param  mixed $MessagesDetails
     * @return void
     */
    public function createMessage(array $MessagesDetails);

    /**
     * getMessage
     *
     * @param  mixed $Message
     * @return void
     */
    public function getMessage(int $Message);

    /**
     * updateMessage
     *
     * @param  mixed $Message
     * @param  mixed $MessageDetails
     * @return void
     */
    public function updateMessage(int $Message, array $MessageDetails);

    /**
     * deleteMessage
     *
     * @param  mixed $Message
     * @return void
     */
    public function deleteMessage(int $Message);

    /**
     * userMessages
     *
     * @param  mixed $userId
     * @return void
     */
    public function userMessages($userId);


}
