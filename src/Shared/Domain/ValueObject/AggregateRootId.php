<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\Uuid;

trait AggregateRootId
{
    public readonly AbstractUid $value;

    final public function __construct(?AbstractUid $value = null)
    {
        $this->value = $value ?? Uuid::v4();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
