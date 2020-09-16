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
        $genre->setName($form->getAttributeValue('name'));
        $genre->setActive((bool) $form->getAttributeValue('active'));

        $transaction = new Transaction($this->orm);
        $transaction->persist($genre);
        $transaction->run();
    }

    public function update(GenreForm $form): void
    {
        /** @var GenreRepository $repository */
        $repository = $this->orm->getRepository(Genre::class);

        $genre = $repository->findOne(['id' => $form->getAttributeValue('id')]);

        $genre->setName($form->getAttributeValue('name'));
        $genre->setActive((bool) $form->getAttributeValue('active'));

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
}
