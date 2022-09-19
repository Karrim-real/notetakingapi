<?php
namespace App\Interfaces;

interface BookInterface
{
    public function getAllBooks();

    public function createBook(array $booksDetails);

    public function getBook(int $book);

    public function updateBook(int $book, array $bookDetails);

    public function deleteBook(int $book);

}
