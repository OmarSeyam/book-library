<?php

namespace App\Traits;

trait Timestampable
{
    private string $createdAt;

    public function initTimestamps(): void
    {
        $this->createdAt = date("Y-m-d H:i:s");
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
