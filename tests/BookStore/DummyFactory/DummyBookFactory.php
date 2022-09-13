<?php

declare(strict_types=1);

namespace App\Tests\BookStore\DummyFactory;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;

final class DummyBookFactory
{
    private function __construct()
    {
    }

    public static function createBook(
        string $name = 'name',
        int $price = 1000,
    ): Book {
        return new Book(
            new BookName($name),
            new Price($price),
        );
    }
}
