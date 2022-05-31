<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use Entity\Tvshow;
use PDO;

class SeasonCollection
{
    /**
     * Cette méthode retourne une liste des saisons correspondant à l'id de la série passé en paramètre
     * @param int $tvshowId
     * @return Tvshow[]
     */

    public static function findByShowId(int $tvshowId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM season
            WHERE tvshowId = :tvshowId
        SQL
        );

        $stmt->execute([':tvshowId' => $tvshowId]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Season::class);
        return $stmt->fetchAll();
    }
}
