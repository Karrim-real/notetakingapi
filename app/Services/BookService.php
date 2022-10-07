<?php

namespace App\Services;

use App\Interfaces\BookInterface;
use App\Models\Book;


class BookService implements BookInterface
{

    public function getAllBooks()
    {
        return Book::latest()->get();
    }

    public function getBook($book)
    {
         $book = Book::find($book);
         if($book){
            return $book;
         }
         return false;
    }

    public function createBook(array $booksDetails)
    {
        return Book::create($booksDetails);
    }

    public function updateBook($book, array $bookDetails)
    {
        return Book::whereId($book)->update($bookDetails);
    }

    public function deleteBook($book)
    {
        return Book::destroy($book);
    }

}
