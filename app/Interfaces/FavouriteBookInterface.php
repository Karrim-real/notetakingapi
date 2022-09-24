<?php
namespace App\Interfaces;

interface FavouriteBookInterface
{
    public function getAllFavouriteBooks();

    public function createFavouriteBook(array $FavouriteBooksDetails);

    public function getFavouriteBook(int $FavouriteBook);

    public function updateFavouriteBook(int $FavouriteBook, array $FavouriteBookDetails);

    public function deleteFavouriteBook(int $FavouriteBook);

    public function userFavouriteBooks($userId);

}
