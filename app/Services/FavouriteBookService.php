<?php

namespace App\Services;

use App\Interfaces\FavouriteBookInterface;
use App\Models\Favouritebook;


class FavouriteBookService implements FavouriteBookInterface
{

    /**
     * getAllFavouriteBooks
     *
     * @return void
     */
    public function getAllFavouriteBooks()
    {
        return Favouritebook::all();
    }

    /**
     * getFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @return void
     */
    public function getFavouriteBook($FavouriteBook)
    {
         $FavouriteBook = Favouritebook::find($FavouriteBook);
         if($FavouriteBook){
            return $FavouriteBook;
         }
         return false;
    }

    /**
     * createFavouriteBook
     *
     * @param  mixed $FavouriteBooksDetails
     * @return void
     */
    public function createFavouriteBook(array $FavouriteBooksDetails)
    {
        return Favouritebook::create($FavouriteBooksDetails);
    }

    /**
     * updateFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @param  mixed $FavouriteBookDetails
     * @return void
     */
    public function updateFavouriteBook($FavouriteBook, array $FavouriteBookDetails)
    {
        return Favouritebook::whereId($FavouriteBook)->update($FavouriteBookDetails);
    }

    /**
     * deleteFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @return void
     */
    public function deleteFavouriteBook($FavouriteBook)
    {
        return Favouritebook::destroy($FavouriteBook);
    }

    /**
     * userFavouriteBooks
     *
     * @param  mixed $userID
     * @return void
     */
    public function userFavouriteBooks($userID)
    {
        return Favouritebook::where('user_id', $userID)->get();
    }

    /**
     * MyFavouriteBooks
     *
     * @param  mixed $userID
     * @param  mixed $book_id
     * @return void
     */
    public function MyFavouriteBooks($userID, $book_id)
    {
        return Favouritebook::where('user_id', $userID)->
        where('book_id', $book_id)->first();
    }



}
