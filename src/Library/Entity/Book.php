<?php

declare(strict_types=1);

namespace App\Library\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;

/**
 * @Entity(repository="App\Library\Repository\BookRepository")
 */
final class Book
{
    /**
     * @Column(type = "bigPrimary")
     */
    private ?int $id = null;

    /** @Column(type = "string") */
    private string $title;

    /** @Column(type = "string") */
    private ?string $isbn = null;

    /** @Column(type = "int") */
    private ?int $page_count = null;

    /** @Column(type = "string") */
    private ?string $description = null;

    /** @Column(type = "int") */
    private int $price_net;

    /** @Column(type = "int") */
    private int $price_gross;

    /** @Column(type = "bool") */
    private bool $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getPageCount(): ?int
    {
        return $this->page_count;
    }

    public function setPageCount(?int $page_count): void
    {
        $this->page_count = $page_count;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPriceNet(): int
    {
        return $this->price_net;
    }

    /**
     * @param int $price_net
     */
    public function setPriceNet(int $price_net): void
    {
        $this->price_net = $price_net;
    }

    public function getPriceGross(): int
    {
        return $this->price_gross;
    }

    public function setPriceGross(int $price_gross): void
    {
        $this->price_gross = $price_gross;
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