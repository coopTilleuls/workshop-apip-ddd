<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class DiscountBookTest extends KernelTestCase
{
    protected function setUp(): void
    {
        static::bootKernel();
    }

    /**
     * @dataProvider applyADiscountOnBookDataProvider
     */
    public function testApplyADiscountOnBook(int $initialAmount, int $discount, int $expectedAmount): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function applyADiscountOnBookDataProvider(): iterable
    {
        yield [100, 0, 100];
        yield [100, 20, 80];
        yield [50, 30, 35];
        yield [50, 100, 0];
    }

    public function testCannotApplyDiscountOnMissingBook(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }
}
