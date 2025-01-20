<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Stringkey\MapperBundle\Exception\MappableEntityNotFoundException;
use Stringkey\MapperBundle\Interface\MappableEntityInterface;
use Stringkey\MapperBundle\Repository\MappableEntityRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'mappable_entity')]
#[ORM\Entity(repositoryClass: MappableEntityRepository::class)]
final class MappableEntity
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[Assert\Length(max: 64)]
    #[ORM\Column(name: 'name', length: 64, nullable: false)]
    private string $name;

    #[Assert\Length(max: 255)]
    #[ORM\Column(name: 'fqcn', length: 255, unique: true, nullable: false, options: ['comment' => 'Fully qualified class name'])]
    private string $fqcn;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    use TimestampableEntity;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getFqcn(): string
    {
        return $this->fqcn;
    }

    /**
     * @throws MappableEntityNotFoundException If the given fully qualified class name is not valid.
     */
    public function setFqcn(string $fqcn): static
    {
        self::isValidFqcn($fqcn, true);

        $this->fqcn = $fqcn;

        return $this;
    }

    public static function constructFromFqcn(string $fqcn): MappableEntity
    {
        self::isValidFqcn($fqcn, true);

        /** @var $fqcn MappableEntityInterface */
        $MappableEntity = new MappableEntity();

        // explicitly assigning to the property to avoid double validation
        $MappableEntity->fqcn = $fqcn;
        $MappableEntity->setName($fqcn::getEntityName());

        return $MappableEntity;
    }

    public static function isValidFqcn(string $fqcn, bool $throwOnError = true): bool
    {
        if (!class_exists($fqcn)) {
            if ($throwOnError) {
                throw new MappableEntityNotFoundException(sprintf('The given fully qualified class name "%s" is not a class.', $fqcn));
            }
            return false;
        }

        if (!in_array(MappableEntityInterface::class, class_implements($fqcn))) {
            if ($throwOnError) {
                throw new MappableEntityNotFoundException(sprintf('The given class name "%s" does not implement the MappableEntityInterface.', $fqcn));
            }
            return false;
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
