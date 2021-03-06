<?php

declare(strict_types=1);

namespace App\Library\Service;

use App\Library\Entity\Author;
use App\Library\Entity\BookAuthor;
use App\Library\Entity\BookGenre;
use App\Library\Entity\Genre;
use App\Library\Repository\AuthorRepository;
use App\Library\Repository\BookAuthorRepository;
use App\Library\Repository\BookGenreRepository;
use App\Library\Repository\GenreRepository;
use Cycle\ORM\Transaction;
use Cycle\ORM\ORMInterface;
use App\Library\Entity\Book;
use App\Library\Form\BookForm;
use App\Library\Repository\BookRepository;

final class BookService
{
    private ORMInterface $orm;

    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    public function create(BookForm $form)
    {
        $book = new Book;
        $this->fillEntity($book, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($book);
        $transaction->run();
    }

    public function update(int $id, BookForm $form)
    {
        /** @var BookRepository $repository */
        $repository = $this->orm->getRepository(Book::class);

        /** @var Book $book */
        $book = $repository->findOne(['id' => $id]);

        $this->fillEntity($book, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($book);
        $transaction->run();
    }

    public function delete(int $id)
    {
        $transaction = new Transaction($this->orm);

        /** @var BookGenreRepository $pivotRepository */
        $pivotRepository = $this->orm->getRepository(BookGenre::class);

        foreach ($pivotRepository->findAll(['book_id' => $id]) as $item) {
            $transaction->delete($item);
        }

        /** @var BookAuthorRepository $pivotRepository */
        $pivotRepository = $this->orm->getRepository(BookAuthor::class);

        foreach ($pivotRepository->findAll(['book_id' => $id]) as $item) {
            $transaction->delete($item);
        }

        /** @var BookRepository $repository */
        $repository = $this->orm->getRepository(Book::class);
        /** @var Book $book */
        $book = $repository->findOne(['id' => $id]);

        $transaction->delete($book);
        $transaction->run();
    }

    private function fillEntity(Book $entity, BookForm $form): Book
    {
        $entity->setTitle($form->getAttributeValue('title'));

        $entity->setIsbn($form->getAttributeValue('isbn') ?? null);
        $entity->setPageCount((int) $form->getAttributeValue('page_count') ?? null);
        $entity->setDescription($form->getAttributeValue('description') ?? null);

        $entity->setPriceNet((int) $form->getAttributeValue('price_net'));
        $entity->setPriceGross((int) $form->getAttributeValue('price_gross'));
        $entity->setActive((bool) $form->getAttributeValue('active'));

        // authors
        $ids = explode(',', $form->getAttributeValue('authors'));
        /** @var AuthorRepository $repository */
        $repository = $this->orm->getRepository(Author::class);
        /** @var Author[] $authors */
        $authors = $repository->allActive();
        foreach ($authors as $author) {
            if (in_array($author->getId(), $ids) && !$entity->getAuthors()->contains($author)) {
                $entity->getAuthors()->add($author);
            }
            if (!in_array($author->getId(), $ids) && $entity->getAuthors()->contains($author)) {
                $entity->getAuthors()->removeElement($author);
            }
        }

        // genres
        $ids = explode(',', $form->getAttributeValue('genres'));
        /** @var GenreRepository $repository */
        $repository = $this->orm->getRepository(Genre::class);
        /** @var Genre[] $genres */
        $genres = $repository->allActive();
        foreach ($genres as $genre) {
            if (in_array($genre->getId(), $ids) && !$entity->getGenres()->contains($genre)) {
                $entity->getGenres()->add($genre);
            }
            if (!in_array($genre->getId(), $ids) && $entity->getGenres()->contains($genre)) {
                $entity->getGenres()->removeElement($genre);
            }
        }

        return $entity;
    }
}
