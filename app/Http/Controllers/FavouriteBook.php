<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouritebookRequest;
use App\Services\FavouriteBookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * FavouriteBook
 */
class FavouriteBook extends Controller
{

    /**
     * favouriteBookService
     *
     * @var mixed
     */
    protected $favouriteBookService;

    /**
     * __construct
     *
     * @param  mixed $favouriteBook
     * @return void
     */
    public function __construct(FavouriteBookService $favouriteBook)
    {
        $this->favouriteBookService = $favouriteBook;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->favouriteBookService->getAllFavouriteBooks())
        {
            $favouriteBooks = $this->favouriteBookService->getAllFavouriteBooks();
            foreach ($favouriteBooks as $favouriteBook) {
                $favouriteBook->users;
                $favouriteBook->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $favouriteBookuser,
                'book' => $favouriteBooks,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Book Available'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavouritebookRequest $request)
    {
        $data = $request->validated();
        // return $data;
        if($this->favouriteBookService->MyFavouriteBooks($data['user_id'], $data['book_id'])){

            return response()->json([
                'status' => 'warning',
                'statusCode' => 501,
                'message' => 'Book Already added!'
            ]);
        }


            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Book Added',
                'data' => $this->favouriteBookService->createFavouriteBook($data)
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($favouritebook)
    {
        if($this->favouriteBookService->getFavouriteBook($favouritebook)){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'data' => $this->favouriteBookService->getFavouriteBook($favouritebook),
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Book Match this ID'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FavouritebookRequest $request, $favouritebook)
    {
        $data = $request->validated();
        if(!$this->favouriteBookService->getFavouriteBook($favouritebook)){
            return response()->json([
                'status' => 'warning',
                'statusCode' => 404,
                'message' => 'No Book Match this ID',
            ]);
        }
        $updateFavouriteBook = $this->favouriteBookService->updateFavouriteBook($favouritebook, $data);
        if($updateFavouriteBook){
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
    public function destroy($favouritebook)
    {
        if($this->favouriteBookService->getFavouriteBook($favouritebook)){
            // return $checkBook->image;

            return response()->json([
                'status' => 'sucess',
                'statusCode' => 200,
                'data' => $this->favouriteBookService->deleteFavouriteBook($favouritebook)
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Favourite Book Match this ID'
        ]);
    }



    /**
     * getUserFavouriteBook
     *
     * @return void
     */
    public function getUserFavouriteBook()
    {
        // $user_id = 2;
        $user_id = Auth::user()->id;
        // return response()->json($user_id);
        if($this->favouriteBookService->userFavouriteBooks($user_id))
        {
            $favouriteBooks = $this->favouriteBookService->userFavouriteBooks($user_id);
            foreach ($favouriteBooks as $favouriteBook) {
                $favouriteBook->books;
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'users' => $favouriteBooks->users,
                'books' => $favouriteBooks,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Book Available'
        ]);

        }

        /**
         * DeleteFavourite
         *
         * @param  mixed $favouritebook
         * @return void
         */
        public function DeleteFavourite($favouritebook)
        {
            // return $favouritebook;
            if($this->favouriteBookService->getFavouriteBook($favouritebook)){
               return response()->json([
                'status' => 'sucess',
                'statusCode' => 200,
                'message' => 'Book remove from favourite',
                'data' => $this->favouriteBookService->deleteFavouriteBook($favouritebook),
            ], 200);
            }
            return response()->json([
                'status' => 'error',
                'statusCode' => 501,
                'data' => 'No Book Available'
            ]);

        }

}
