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
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function testRemove(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function testOfId(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function testIterator(): void
    {
        $this->markTestSkipped('This will work when "save" will be implemented');

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
        $this->markTestSkipped('This will work when "save" will be implemented');

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
