<?php

declare(strict_types=1);

namespace App\Library\Service;

use App\Library\Entity\BookAuthor;
use App\Library\Repository\BookAuthorRepository;
use DateTimeImmutable;
use Cycle\ORM\Transaction;
use Cycle\ORM\ORMInterface;
use App\Library\Entity\Author;
use App\Library\Form\AuthorForm;
use App\Library\Repository\AuthorRepository;

final class AuthorService
{
    private ORMInterface $orm;

    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    public function create(AuthorForm $form)
    {
        $author = new Author;
        $this->fillEntity($author, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($author);
        $transaction->run();
    }

    public function update(int $id, AuthorForm $form)
    {
        /** @var AuthorRepository $repository */
        $repository = $this->orm->getRepository(Author::class);

        /** @var Author $author */
        $author = $repository->findOne(['id' => $id]);

        $this->fillEntity($author, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($author);
        $transaction->run();
    }

    public function delete(int $id)
    {
        $transaction = new Transaction($this->orm);

        /** @var BookAuthorRepository $pivotRepository */
        $pivotRepository = $this->orm->getRepository(BookAuthor::class);

        foreach ($pivotRepository->findAll(['author_id' => $id]) as $item) {
            $transaction->delete($item);
        }

        /** @var AuthorRepository $repository */
        $repository = $this->orm->getRepository(Author::class);
        /** @var Author $author */
        $author = $repository->findOne(['id' => $id]);

        $transaction->delete($author);
        $transaction->run();
    }

    private function fillEntity(Author $entity, AuthorForm $form): Author
    {
        $entity->setName($form->getAttributeValue('name'));
        $entity->setSurname($form->getAttributeValue('surname'));
        $entity->setBirthday($form->getAttributeValue('birthday') ? new DateTimeImmutable($form->getAttributeValue('birthday')) : null);
        $entity->setActive((bool) $form->getAttributeValue('active'));

        return $entity;
    }
}
