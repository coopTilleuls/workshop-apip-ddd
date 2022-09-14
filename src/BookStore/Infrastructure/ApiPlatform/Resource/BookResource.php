<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Infrastructure\ApiPlatform\Payload\DiscountBookPayload;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Book',
    operations: [
        new Get(),
        new Post(
            '/books/{id}/discount.{_format}',
            openapiContext: ['summary' => 'Apply a discount percentage on a Book resource.'],
            input: DiscountBookPayload::class,
        ),
    ],
)]
final class BookResource
{
    public function __construct(
        #[ApiProperty(identifier: true, readable: false, writable: false)]
        public ?AbstractUid $id = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\Length(min: 1, max: 255, groups: ['create', 'Default'])]
        public ?string $name = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\PositiveOrZero(groups: ['create', 'Default'])]
        public ?int $price = null,
    ) {
    }

    public static function fromModel(Book $book): static
    {
        return new self(
            $book->id()->value,
            $book->name()->value,
            $book->price()->amount,
        );
    }
}
