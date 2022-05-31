<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Tvshow;
use PDO;

class SeasonCollection
{
    /**
     * Cette méthode retourne une liste des saisons correspondant à l'id de la série passé en paramètre
     * @param int $showId
     * @return Tvshow[]
     */
    public static function findByShowId(int $showId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM season
            WHERE showId = :showId
        SQL
        );

        $stmt->execute([':showId' => $showId]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        return $stmt->fetchAll();
    }

}
