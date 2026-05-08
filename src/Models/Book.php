<?php

namespace App\Models;

use App\Contracts\Discountable;
use App\Traits\Timestampable;

class Book implements Discountable 
{
    use Timestampable;

    public function __construct(readonly int $id, public string $title, public string $author, public float $price, public int $stock = 0)
    {
        $this->initTimestamps();
    }

    public function summary(): string
    {
        return "[{$this->id}] {$this->title} by {$this->author} — \${$this->price} ({$this->stock} in stock)";
    }

    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }

    public function checkout(): void
    {
        if (!$this->isAvailable()) {
            throw new \RuntimeException("Book is not available.");
        }
        $this->stock--;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->summary() . " (Created at: {$this->getCreatedAt()})";
    }

    public function applyDiscount(float $pct):float
    {
        return $this->price * (1 - $pct/100);
    }
}
