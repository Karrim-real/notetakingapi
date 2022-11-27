<?php

namespace App\Services;

use App\Interfaces\BookInterface;
use App\Models\Book;


/**
 * BookService
 */
class BookService implements BookInterface
{

    /**
     * getAllBooks
     *
     * @return void
     */
    public function getAllBooks()
    {
        return Book::latest()->get();
    }

    /**
     * getBook
     *
     * @param  mixed $book
     * @return void
     */
    public function getBook($book)
    {
         $book = Book::find($book);
         if($book){
            return $book;
         }
         return false;
    }

    /**
     * createBook
     *
     * @param  mixed $booksDetails
     * @return void
     */
    public function createBook(array $booksDetails)
    {
        return Book::create($booksDetails);
    }

    /**
     * updateBook
     *
     * @param  mixed $book
     * @param  mixed $bookDetails
     * @return void
     */
    public function updateBook($book, array $bookDetails)
    {
        return Book::whereId($book)->update($bookDetails);
    }

    /**
     * deleteBook
     *
     * @param  mixed $book
     * @return void
     */
    public function deleteBook($book)
    {
        return Book::destroy($book);
    }

}
