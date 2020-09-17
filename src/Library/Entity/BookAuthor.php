<?php

declare(strict_types=1);

namespace App\Library\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;

/**
 * @Entity(repository="App\Library\Repository\BookAuthorRepository")
 */
final class BookAuthor
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
    private ?int $author_id = null;

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

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
    }
}
