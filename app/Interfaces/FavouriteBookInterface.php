<?php
namespace App\Interfaces;

interface FavouriteBookInterface
{
    /**
     * getAllFavouriteBooks
     *
     * @return void
     */
    public function getAllFavouriteBooks();

    /**
     * createFavouriteBook
     *
     * @param  mixed $FavouriteBooksDetails
     * @return void
     */
    public function createFavouriteBook(array $FavouriteBooksDetails);

    /**
     * getFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @return void
     */
    public function getFavouriteBook(int $FavouriteBook);

    /**
     * updateFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @param  mixed $FavouriteBookDetails
     * @return void
     */
    public function updateFavouriteBook(int $FavouriteBook, array $FavouriteBookDetails);

    /**
     * deleteFavouriteBook
     *
     * @param  mixed $FavouriteBook
     * @return void
     */
    public function deleteFavouriteBook(int $FavouriteBook);

    /**
     * userFavouriteBooks
     *
     * @param  mixed $userId
     * @return void
     */
    public function userFavouriteBooks($userId);

}
