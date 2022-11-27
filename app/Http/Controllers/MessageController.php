<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * MessageController
 */
class MessageController extends Controller
{
    /**
     * messageService
     *
     * @var mixed
     */
    protected $messageService;

    /**
     * __construct
     *
     * @param  mixed $message
     * @return void
     */
    public function __construct(MessageService $message)
    {
        $this->messageService = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->messageService->getAllMessages()->count() < 1)
        {
            $messages = $this->messageService->getAllMessages();
            foreach ($messages as $message) {
                $message->users;
                $message->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $messageuser,
                'data' => $messages,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No message Available'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();
        // return $data
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Book Added',
                'data' => $this->messageService->createMessage($data),
                // 'link' => config('app.url').'/'.Auth::user()->username.'/',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($message)
    {
        if($this->messageService->getMessage($message)){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'data' => $this->messageService->getMessage($message),
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No Message Match this ID'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, $message)
    {
        $data = $request->validated();
        if(!$this->messageService->getMessage($message)){
            return response()->json([
                'status' => 'warning',
                'statusCode' => 404,
                'message' => 'No Message Match this ID',
            ]);
        }
        $updatemessage = $this->messageService->updateMessage($message, $data);
        if($updatemessage){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Message Updated',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'statusCode' => 501,
                'message' => 'An error occur',
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($message)
    {
        if($this->messageService->getMessage($message)){
            // return $checkBook->image;

            return response()->json([
                'status' => 'sucess',
                'statusCode' => 200,
                'data' => $this->messageService->deleteMessage($message)
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No message Match this ID'
        ]);
    }



    /**
     * getUsermessage
     *
     * @return void
     */
    public function getUsermessage()
    {
        // $user_id = 2;
        $user_id = Auth::user()->id;
        // return response()->json($user_id);
        if($this->messageService->userMessages($user_id))
        {
            $messages = $this->messageService->userMessages($user_id);
            foreach ($messages as $message) {
                $message->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $messages->users,
                'data' => $messages,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No message Available'
        ]);

        }

}
