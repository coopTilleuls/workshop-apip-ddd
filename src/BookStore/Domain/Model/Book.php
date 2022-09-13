<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Discount;
use App\BookStore\Domain\ValueObject\Price;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Book
{
    #[ORM\Embedded(columnPrefix: false)]
    private readonly BookId $id;

    public function __construct(
        #[ORM\Embedded(columnPrefix: false)]
        private BookName $name,

        #[ORM\Embedded(columnPrefix: false)]
        private Price $price,
    ) {
        $this->id = new BookId();
    }

    public function id(): BookId
    {
        return $this->id;
    }

    public function name(): BookName
    {
        return $this->name;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function rename(BookName $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function applyDiscount(Discount $discount): static
    {
        $this->price = $this->price->applyDiscount($discount);

        return $this;
    }
}
