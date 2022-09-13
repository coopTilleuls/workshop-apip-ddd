<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Unit;

use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    public function testRename(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    /**
     * @dataProvider applyDiscountDataProvider
     */
    public function testApplyDiscount(int $initialAmount, int $discount, int $expectedAmount): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function applyDiscountDataProvider(): iterable
    {
        yield [100, 0, 100];
        yield [100, 20, 80];
        yield [50, 30, 35];
        yield [50, 100, 0];
    }
}
