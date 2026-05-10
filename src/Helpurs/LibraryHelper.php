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

    public static function availableBooks(array $books): string
    {
        $books_srt = "";
        foreach ($books as $book) {
            $is_available = $book->isAvailable() ? 'true' : 'false';
            $books_srt .= "{
                    'id': {$book->id},
                    'title': '{$book->title}',
                    'author': '{$book->author}',
                    'price': {$book->price},
                    'stock': {$book->stock},
                    'available': {$is_available}
                }";
        }
        return ("{
            'library': {
                'name': 'PHP Course Sample Library',
                'version': '1.0',
                'total_books': 20
            },
            'books': [ " . $books_srt . "] }");
    }
}
