<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * BookController
 */
class BookController extends Controller
{
    /**
     * bookService
     *
     * @var mixed
     */
    protected $bookService;

    /**
     * __construct
     *
     * @param  mixed $bookService
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
        // $this->middleware('auth:sanctum')->except('show', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return ;
        if($this->bookService->getAllBooks()){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Update By Remote',
                'data' => $this->bookService->getAllBooks(),
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
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['isFavourite'] = $request->isFavourite == true ? 1 : 0;
        // return $data;
        $files = $request->file('image');

        $fileName = time().'.png';
        // return $file->getClientOriginalName();
        $destination = 'public/assets/images/';
        // return env('APP_URL');
        $files->storeAs($destination, $fileName);
           $data['image'] = config('app.image_path').$fileName;
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'data' => $this->bookService->createBook($data)
            ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book)
    {
        if($this->bookService->getBook($book)){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                // 'uuid' => Str::orderedUuid(),
                'data' => $this->bookService->getBook($book),
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
    public function update(UpdateBookRequest $request, $book)
    {
        $data = $request->validated();
        // return $data['isFavourite'];
        // return $data;
        $data['isFavourite'] = $request->isFavourite === true ? 1 : 0;

        if(!$this->bookService->getBook($book)){
            return response()->json([
                'status' => 'warning',
                'statusCode' => 404,
                'message' => 'No Book Match this ID',
            ]);
        }
        // return $data;
        $checkBook = $this->bookService->getBook($book);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $existingDestination = $checkBook->image;
            if(Storage::exists($existingDestination)){
                Storage::delete($existingDestination);
            }
            $destination = 'public/assets/images';
            $filename = time().'.png';
            $file->storeAs($destination, $filename);
            $data['image'] = config('app.image_path').$filename;
        }

        $updateBook = $this->bookService->updateBook($book, $data);
        if($updateBook){
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Book Updated',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'message' => 'No Book Match this ID',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        if($this->bookService->getBook($book)){
            $checkBook = $this->bookService->getBook($book);
            // return $checkBook->image;
            $existingDestination = $checkBook->image;
            if(Storage::exists($existingDestination)){
                Storage::delete($existingDestination);
            }
            return response()->json([
                'status' => 'sucess',
                'statusCode' => 200,
                'data' => $this->bookService->deleteBook($book)
            ]);
        }
        return response()->json([
            'status' => 'error',
            'statusCode' => 501,
            'data' => 'No Book Match this ID'
        ]);
    }
}
