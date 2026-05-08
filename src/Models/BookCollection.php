<?php

namespace App\Models;

class BookCollection
{
    private array $books = [];
    public function add(Book $book): void
    {
        $this->books[$book->getId()] = $book;
    }

    public function findById(int $id): ?Book
    {
        return $this->books[$id] ?? null;
    }

    public function count():int
    {
        return \count($this->books);
    }

    public function __toString(): string
    {
        $book= \array_map(fn($book) => (string) $book, $this->books);
        return \implode("\n", $book);
    }


}
