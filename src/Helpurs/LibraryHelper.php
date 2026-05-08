<?php

namespace App\Helpurs;

class LibraryHelper
{

    public function formatTitle(string $title): string
    {
        return ucfirst(trim($title));
    }

    public function filterByAuthor(array $books, string $author): array
    {
        return array_filter($books, fn($book) => stripos($book->author, $author) !== false);
    }

    public function sortByPrice(array $books, string $dir = 'asc'): array
    {
        $arr_prices = array_map(fn($book) => $book->price, $books);

        usort($arr_prices, function ($a, $b) use ($dir) {
            if ($dir === 'asc') return $a <=> $b;
            return $b <=> $a;
        });
        return $books;
    }

    public function totalValue(array $books): float
    {
        return array_reduce($books, fn($carry, $book) => $carry + ($book->price * $book->stock), 0.0);
    }

    public function searchByKeyword(array $books, string $kw): array
    {
        return array_filter($books, fn($book) => stripos($book->title, $kw) !== false || stripos($book->author, $kw) !== false);
    }

    public static function availableBooks(array $books): array
    {
        return array_filter(
            $books,
            fn($book) => $book->isAvailable() // $book->stock > 0
        );
    }
}
