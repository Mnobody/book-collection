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
}
