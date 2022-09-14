<?php

declare(strict_types=1);

namespace App\Subscription\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Subscription
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        #[ORM\GeneratedValue(strategy: 'CUSTOM')]
        #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
        public ?Uuid $id = null,

        #[Assert\NotBlank(groups: ['create'])]
        #[Assert\Email(groups: ['create', 'Default'])]
        #[ORM\Column(name: 'name', nullable: false)]
        public ?string $email = null,
    ) {
    }
}
