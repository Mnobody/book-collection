<?php

declare(strict_types=1);

namespace App\Library\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use DateTimeImmutable;

/**
 * @Entity(repository="App\Library\Repository\AuthorRepository")
 */
final class Author
{
    /**
     * @Column(type = "bigPrimary")
     */
    private ?int $id = null;

    /** @Column(type = "string") */
    private string $name;

    /** @Column(type = "string") */
    private string $surname;

    /** @Column(type = "timestamp") */
    private ?DateTimeImmutable $birthday = null;

    /** @Column(type = "bool") */
    private bool $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getBirthday(): ?DateTimeImmutable
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
