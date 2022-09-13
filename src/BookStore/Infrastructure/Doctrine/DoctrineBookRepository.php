<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Doctrine;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\BookId;
use App\Shared\Infrastructure\Doctrine\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends DoctrineRepository<Book>
 */
final class DoctrineBookRepository extends DoctrineRepository implements BookRepositoryInterface
{
    private const ENTITY_CLASS = Book::class;
    private const ALIAS = 'book';

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, self::ENTITY_CLASS, self::ALIAS);
    }

    public function save(Book $book): void
    {
        throw new \BadMethodCallException('I need to be implemented');
    }

    public function remove(Book $book): void
    {
        throw new \BadMethodCallException('I need to be implemented');
    }

    public function ofId(BookId $id): ?Book
    {
        throw new \BadMethodCallException('I need to be implemented');
    }
}
