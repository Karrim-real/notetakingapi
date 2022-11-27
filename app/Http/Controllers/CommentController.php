<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * commentService
     *
     * @var mixed
     */
    protected $commentService;

    /**
     * __construct
     *
     * @param  mixed $comment
     * @return void
     */
    public function __construct(CommentService $comment)
    {
        $this->commentService = $comment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->commentService->getAllComments())
        {
            $comments = $this->commentService->getAllComments();
            foreach ($comments as $comment) {
                $comment->users;
                $comment->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $commentuser,
                'book' => $comments,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Comment Available'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        // return $data
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'comment' => 'Comment Added',
                'data' => $this->commentService->createComment($data)
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        if($this->commentService->getComment($comment)){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'data' => $this->commentService->getComment($comment),
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Comment Match this ID'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $comment)
    {
        $data = $request->validated();
        if(!$this->commentService->getComment($comment)){
            return response()->json([
                'status' => 'warning',
                'statusCode' => 404,
                'message' => 'No Comment Match this ID',
            ]);
        }
        $updatecomment = $this->commentService->updateComment($comment, $data);
        if($updatecomment){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Book Updated',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'statusCode' => 501,
                'message' => 'No Book Match this ID',
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment)
    {
        if($this->commentService->getComment($comment)){
            // return $checkBook->image;

            return response()->json([
                'status' => 'sucess',
                'statusCode' => 200,
                'data' => $this->commentService->deleteComment($comment)
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Comment Match this ID'
        ]);
    }



    public function getUsercomment()
    {
        // $user_id = 2;
        $user_id = Auth::user()->id;
        // return response()->json($user_id);
        if($this->commentService->userComments($user_id))
        {
            $comments = $this->commentService->userComments($user_id);
            foreach ($comments as $comment) {
                $comment->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $comments->users,
                'data' => $comments,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No  Comment Available'
        ]);

        }

}
