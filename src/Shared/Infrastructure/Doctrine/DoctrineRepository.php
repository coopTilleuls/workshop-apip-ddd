<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine;

use App\Shared\Domain\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * @template T of object
 *
 * @implements RepositoryInterface<T>
 */
abstract class DoctrineRepository implements RepositoryInterface
{
    private ?int $page = null;
    private ?int $itemsPerPage = null;

    private QueryBuilder $queryBuilder;

    public function __construct(
        protected EntityManagerInterface $em,
        string $entityClass,
        string $alias,
    ) {
        $this->queryBuilder = $this->em->createQueryBuilder()
            ->select($alias)
            ->from($entityClass, $alias);
    }

    public function getIterator(): \Iterator
    {
        /** @var array<T> $result */
        $result = $this->queryBuilder->getQuery()->getResult();

        yield from $result;
    }

    public function count(): int
    {
        return (int) (clone $this->queryBuilder)
            ->select('count(1)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    protected function query(): QueryBuilder
    {
        return clone $this->queryBuilder;
    }

    protected function __clone()
    {
        $this->queryBuilder = clone $this->queryBuilder;
    }
}
