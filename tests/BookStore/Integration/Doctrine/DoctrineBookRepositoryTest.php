<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Integration\Doctrine;

use App\BookStore\Infrastructure\Doctrine\DoctrineBookRepository;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

final class DoctrineBookRepositoryTest extends KernelTestCase
{
    private static Connection $connection;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::bootKernel();

        static::$connection = static::getContainer()->get(Connection::class);

        (new Application(static::$kernel))
            ->find('doctrine:database:create')
            ->run(new ArrayInput(['--if-not-exists' => true]), new NullOutput());

        (new Application(static::$kernel))
            ->find('doctrine:schema:update')
            ->run(new ArrayInput(['--force' => true]), new NullOutput());
    }

    protected function setUp(): void
    {
        static::bootKernel();
        static::$connection->executeStatement('TRUNCATE book');
    }

    public function testSave(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = static::getContainer()->get(DoctrineBookRepository::class);

        static::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->save($book);

        static::assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = static::getContainer()->get(DoctrineBookRepository::class);

        $book = DummyBookFactory::createBook();
        $repository->save($book);

        static::assertCount(1, $repository);

        $repository->remove($book);
        static::assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = static::getContainer()->get(DoctrineBookRepository::class);

        static::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->save($book);

        static::assertSame($book, $repository->ofId($book->id()));
    }

    public function testIterator(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = static::getContainer()->get(DoctrineBookRepository::class);

        $books = [
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
        ];
        foreach ($books as $book) {
            $repository->save($book);
        }

        $i = 0;
        foreach ($repository as $book) {
            static::assertSame($books[$i], $book);
            ++$i;
        }
    }

    public function testCount(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = static::getContainer()->get(DoctrineBookRepository::class);

        $books = [
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
        ];
        foreach ($books as $book) {
            $repository->save($book);
        }

        static::assertCount(count($books), $repository);
    }
}
