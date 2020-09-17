<?php

declare(strict_types=1);

namespace App\Library\Service;

use Cycle\ORM\Transaction;
use Cycle\ORM\ORMInterface;
use App\Library\Entity\Genre;
use App\Library\Form\GenreForm;
use App\Library\Repository\GenreRepository;

final class GenreService
{
    private ORMInterface $orm;

    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    public function create(GenreForm $form): void
    {
        $genre = new Genre;
        $this->fillEntity($genre, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($genre);
        $transaction->run();
    }

    public function update(int $id, GenreForm $form): void
    {
        /** @var GenreRepository $repository */
        $repository = $this->orm->getRepository(Genre::class);

        /** @var Genre $genre */
        $genre = $repository->findOne(['id' => $id]);

        $this->fillEntity($genre, $form);

        $transaction = new Transaction($this->orm);
        $transaction->persist($genre);
        $transaction->run();
    }

    public function delete(int $id)
    {
        /** @var GenreRepository $repository */
        $repository = $this->orm->getRepository(Genre::class);

        $genre = $repository->findOne(['id' => $id]);

        $transaction = new Transaction($this->orm);
        $transaction->delete($genre);
        $transaction->run();
    }

    private function fillEntity(Genre $entity, GenreForm $form): Genre
    {
        $entity->setName($form->getAttributeValue('name'));
        $entity->setActive((bool) $form->getAttributeValue('active'));

        return $entity;
    }
}
