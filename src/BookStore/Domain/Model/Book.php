<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\ValueObject\BookId;

class Book
{
    private readonly BookId $id;

    public function __construct()
    {
        $this->id = new BookId();
    }

    public function id(): BookId
    {
        return $this->id;
    }
}
