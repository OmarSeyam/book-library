<?php
include_once("../../vendor/autoload.php");


use App\Models\Book;
use App\Models\BookCollection;
use App\Readers\CsvReader;
use App\Helpurs\LibraryHelper;
use App\Writers\ReportWriter;


$books = CsvReader::load('../../data/books.csv');

$availableBooks = LibraryHelper::availableBooks($books);

ReportWriter::write(
    $availableBooks,
    '../../reports/library.json'
);



// $book1 = new Book(1, "The Great Gatsby", "F. Scott Fitzgerald", 10.99, 5);
// $book2 = new Book(2, "To Kill a Mockingbird", "Harper Lee", 12.99, 3);
// $book3 = new Book(3, "1984", "George Orwell", 11.99, 7);

// $collection = new BookCollection();
// $collection->add($book1);
// $collection->add($book2);
// $collection->add($book3);

// echo $collection;