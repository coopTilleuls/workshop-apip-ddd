<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Unit;

use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Discount;
use App\BookStore\Domain\ValueObject\Price;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    public function testRename(): void
    {
        $book = DummyBookFactory::createBook(name: 'name');
        $book->rename(new BookName('new name'));

        static::assertEquals(new BookName('new name'), $book->name());
    }

    /**
     * @dataProvider applyDiscountDataProvider
     */
    public function testApplyDiscount(int $initialAmount, int $discount, int $expectedAmount): void
    {
        $book = DummyBookFactory::createBook(price: $initialAmount);
        $book->applyDiscount(new Discount($discount));

        static::assertEquals(new Price($expectedAmount), $book->price());
    }

    public function applyDiscountDataProvider(): iterable
    {
        yield [100, 0, 100];
        yield [100, 20, 80];
        yield [50, 30, 35];
        yield [50, 100, 0];
    }
}
