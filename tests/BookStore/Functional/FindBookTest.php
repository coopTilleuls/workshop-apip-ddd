<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FindBookTest extends KernelTestCase
{
    protected function setUp(): void
    {
        static::bootKernel();
    }

    public function testFindBook(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }
}
