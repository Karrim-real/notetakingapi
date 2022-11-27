<?php
namespace App\Interfaces;

interface BookInterface
{
    /**
     * getAllBooks
     *
     * @return void
     */
    public function getAllBooks();

    /**
     * createBook
     *
     * @param  mixed $booksDetails
     * @return void
     */
    public function createBook(array $booksDetails);

    /**
     * getBook
     *
     * @param  mixed $book
     * @return void
     */
    public function getBook(int $book);

    /**
     * updateBook
     *
     * @param  mixed $book
     * @param  mixed $bookDetails
     * @return void
     */
    public function updateBook(int $book, array $bookDetails);

    /**
     * deleteBook
     *
     * @param  mixed $book
     * @return void
     */
    public function deleteBook(int $book);

}
