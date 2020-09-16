<?php

declare(strict_types=1);

namespace App\Library\Service;

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
        $author->setName($form->getAttributeValue('name'));
        $author->setSurname($form->getAttributeValue('surname'));
        if ($birthday = $form->getAttributeValue('birthday')) {
            $author->setBirthday(new DateTimeImmutable($birthday));
        }
        $author->setActive((bool) $form->getAttributeValue('active'));

        $transaction = new Transaction($this->orm);
        $transaction->persist($author);
        $transaction->run();
    }

    public function update(AuthorForm $form)
    {
        /** @var AuthorRepository $repository */
        $repository = $this->orm->getRepository(Author::class);

        $author = $repository->findOne(['id' => $form->getAttributeValue('id')]);

        $author->setName($form->getAttributeValue('name'));
        $author->setSurname($form->getAttributeValue('surname'));
        if ($birthday = $form->getAttributeValue('birthday')) {
            $author->setBirthday(new DateTimeImmutable($birthday));
        } else {
            $author->setBirthday(null);
        }
        $author->setActive((bool) $form->getAttributeValue('active'));

        $transaction = new Transaction($this->orm);
        $transaction->persist($author);
        $transaction->run();
    }

    public function delete(int $id)
    {
        /** @var AuthorRepository $repository */
        $repository = $this->orm->getRepository(Author::class);

        $author = $repository->findOne(['id' => $id]);

        $transaction = new Transaction($this->orm);
        $transaction->delete($author);
        $transaction->run();
    }
}
