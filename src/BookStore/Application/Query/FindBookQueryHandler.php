<?php

declare(strict_types=1);

namespace App\BookStore\Application\Query;

use App\BookStore\Domain\Model\Book;
use App\Shared\Application\Query\QueryHandlerInterface;

final class FindBookQueryHandler implements QueryHandlerInterface
{
    public function __invoke(FindBookQuery $query): ?Book
    {
        throw new \BadMethodCallException('I might be implemented');
    }
}
