<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use Entity\Genre;
use Entity\Tvshow_Genre;
use PDO;

class GenreCollection
{
    /**
     * Cette méthode retourne les genres d'une série
     * @param int $showId
     * @return array
     */

    public static function findByTvshowId(int $showId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM genre
            WHERE id = :id
        SQL
        );

        $stmt->execute([':id' => $showId]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Genre::class);
        return $stmt->fetchAll();
    }
}
