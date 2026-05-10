<?php

namespace App\Writers;

class ReportWriter
{
    public static function write(string $books, string $path): void
    {
        $handle = fopen($path, 'w');

        if ($handle) {

            // foreach ($books as $book) {

            fwrite(
                $handle,
                $books //. PHP_EOL
            );
            // }

            fclose($handle);
        }
    }
}
