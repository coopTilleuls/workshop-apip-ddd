<?php

declare(strict_types=1);

namespace App\BookStore\Domain\ValueObject;

use App\Shared\Domain\ValueObject\AggregateRootId;

final class BookId implements \Stringable
{
    use AggregateRootId;
}
