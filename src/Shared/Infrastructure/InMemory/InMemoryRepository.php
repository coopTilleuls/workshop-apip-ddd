<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\InMemory;

use App\Shared\Domain\Repository\RepositoryInterface;

/**
 * @template T of object
 *
 * @implements RepositoryInterface<T>
 */
abstract class InMemoryRepository implements RepositoryInterface
{
    /**
     * @var array<string, T>
     */
    protected array $entities = [];

    public function getIterator(): \Iterator
    {
        yield from $this->entities;
    }

    public function count(): int
    {
        return count($this->entities);
    }
}
