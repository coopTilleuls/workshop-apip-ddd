<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

final class FindBookTest extends ApiTestCase
{
    public function testFindBook(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function testCannotFindMissingBook(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }
}
