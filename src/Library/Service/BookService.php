<?php

declare(strict_types=1);

namespace App\Library\Service;

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
        /** @var BookRepository $repository */
        $repository = $this->orm->getRepository(Book::class);

        $book = $repository->findOne(['id' => $id]);

        $transaction = new Transaction($this->orm);
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

        return $entity;
    }
}
