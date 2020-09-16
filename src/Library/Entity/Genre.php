<?php

declare(strict_types=1);

namespace App\Library\Entity;


use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;

/**
 * @Entity(repository="App\Library\Repository\GenreRepository")
 */
final class Genre
{
    /**
     * @Column(type = "bigPrimary")
     */
    private ?int $id = null;

    /** @Column(type = "string") */
    private string $name;

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

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}
