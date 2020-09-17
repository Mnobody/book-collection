<?php

declare(strict_types=1);

namespace App\Library\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Relation\ManyToMany;
use Cycle\ORM\Relation\Pivoted\PivotedCollection;
use \Cycle\ORM\Relation\Pivoted\PivotedCollectionInterface;

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

    /** @ManyToMany(target = "Author", though = "BookAuthor") */
    private PivotedCollectionInterface $authors;

    /** @ManyToMany(target = "Genre", though = "BookGenre") */
    private PivotedCollectionInterface $genres;

    public function __construct()
    {
        $this->authors = new PivotedCollection;
        $this->genres = new PivotedCollection;
    }

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

    public function getPriceNet(): int
    {
        return $this->price_net;
    }

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

    public function getAuthors(): PivotedCollectionInterface
    {
        return $this->authors;
    }

    public function setAuthors(PivotedCollectionInterface $authors): void
    {
        $this->authors = $authors;
    }

    public function getGenres(): PivotedCollectionInterface
    {
        return $this->genres;
    }

    public function setGenres(PivotedCollectionInterface $genres): void
    {
        $this->genres = $genres;
    }
}
