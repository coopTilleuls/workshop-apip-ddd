<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;

final class FindBookTest extends ApiTestCase
{
    public function testFindBook(): void
    {
        $client = static::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = static::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook(
            name: 'name',
            price: 1000,
        );
        $bookRepository->save($book);

        $client->request('GET', sprintf('/api/books/%s', (string) $book->id()));

        static::assertResponseIsSuccessful();
        static::assertMatchesResourceItemJsonSchema(BookResource::class);

        static::assertJsonContains([
            'name' => 'name',
            'price' => 1000,
        ]);
    }

    public function testCannotFindMissingBook(): void
    {
        $client = static::createClient();
        $client->request('GET', sprintf('/api/books/%s', (string) new BookId()));

        static::assertResponseStatusCodeSame(404);
    }
}
