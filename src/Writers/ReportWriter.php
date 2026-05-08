<?php 

namespace App\Writers;

class ReportWriter
{
    public static function write(array $books, string $path): void
    {
        $handle = fopen($path, 'w');

        if ($handle) {

            foreach ($books as $book) {

                fwrite(
                    $handle,
                    $book . PHP_EOL
                );
            }

            fclose($handle);
        }
    }
}