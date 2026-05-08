<?php

namespace App\Readers;

use App\Models\Book;

class CsvReader
{
    public static function load(string $path): array
    {
        $books = [];

        $handle = fopen($path, 'r');

        if ($handle) {

            fgetcsv($handle, 1000, ',', '"', '\\');

            while (($row = fgetcsv($handle, 1000, ',', '"', '\\')) !== false) {

                $books[] = new Book(
                    (int)$row[0],
                    $row[1],
                    $row[2],
                    (float)$row[4],
                    (int)$row[5]
                );
            }

            fclose($handle);
        }

        return $books;
    }
}
