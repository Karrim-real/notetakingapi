<?php

namespace App\Services;

use App\Interfaces\FavouriteBookInterface;
use App\Models\Favouritebook;


class FavouriteBookService implements FavouriteBookInterface
{

    public function getAllFavouriteBooks()
    {
        return Favouritebook::all();
    }

    public function getFavouriteBook($FavouriteBook)
    {
         $FavouriteBook = Favouritebook::find($FavouriteBook);
         if($FavouriteBook){
            return $FavouriteBook;
         }
         return false;
    }

    public function createFavouriteBook(array $FavouriteBooksDetails)
    {
        return Favouritebook::create($FavouriteBooksDetails);
    }

    public function updateFavouriteBook($FavouriteBook, array $FavouriteBookDetails)
    {
        return Favouritebook::whereId($FavouriteBook)->update($FavouriteBookDetails);
    }

    public function deleteFavouriteBook($FavouriteBook)
    {
        return Favouritebook::destroy($FavouriteBook);
    }

    public function userFavouriteBooks($userID)
    {
        return Favouritebook::where('user_id', $userID)->get();
    }



}
