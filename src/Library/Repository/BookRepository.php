<?php

declare(strict_types=1);

namespace App\Library\Repository;

use Cycle\ORM\Select\Repository;
use Yiisoft\Data\Reader\DataReaderInterface;
use Yiisoft\Yii\Cycle\DataReader\SelectDataReader;

final class BookRepository extends Repository
{
    public function list(): DataReaderInterface
    {
        return new SelectDataReader(
            $this->select()->orderBy(['id' => 'DESC'])
        );
    }

    public function search(string $q): DataReaderInterface
    {
        $phrase = '%' . $q . '%';

        return new SelectDataReader(
            $this->select()
                ->with('authors')
                ->with('genres')
                ->where('title', 'like', $phrase)
                ->orWhere('isbn', 'like', $phrase)
                ->orWhere('authors.name', 'like', $phrase)
                ->orWhere('authors.surname', 'like', $phrase)
                ->orWhere('genres.name', 'like', $phrase)
                ->orderBy(['id' => 'DESC'])
        );
    }
}
