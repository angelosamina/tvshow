<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    /**
     * Cette méthode retourne une liste des épisodes correspondant à l'id de la saison passé en paramètre
     * @param int $seasonId
     * @return array
     */

    public static function findBySeasonId(int $seasonId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM episode
            WHERE seasonId = :seasonId
        SQL
        );

        $stmt->execute([':seasonId' => $seasonId]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Episode::class);
        return $stmt->fetchAll();
    }
}