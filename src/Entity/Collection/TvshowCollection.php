<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Tvshow;
use PDO;

class TvshowCollection
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, overview, posterId
            FROM tvshow
            ORDER BY name
        SQL
        );

        $stmt->execute();

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        return $stmt->fetchAll();
    }
}
