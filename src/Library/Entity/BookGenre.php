<?php

declare(strict_types=1);

namespace App\Library\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;

/**
 * @Entity(repository="App\Library\Repository\BookRepository")
 */
final class BookGenre
{
    /**
     * @Column(type = "bigPrimary")
     */
    private ?int $id = null;

    /**
     * @Column(type = "bigInteger")
     */
    private ?int $book_id = null;

    /**
     * @Column(type = "bigInteger")
     */
    private ?int $genre_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): int
    {
        return $this->book_id;
    }

    public function setBookId(int $book_id): void
    {
        $this->book_id = $book_id;
    }

    public function getGenreId(): int
    {
        return $this->genre_id;
    }

    public function setGenreId(int $genre_id): void
    {
        $this->genre_id = $genre_id;
    }
}
