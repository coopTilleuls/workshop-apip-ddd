<?php

declare(strict_types=1);

namespace App\Tests\BookStore\DummyFactory;

use App\BookStore\Domain\Model\Book;

final class DummyBookFactory
{
    private function __construct()
    {
    }

    public static function createBook(): Book
    {
        return new Book();
    }
}
