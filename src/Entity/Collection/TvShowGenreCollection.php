<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use Entity\Tvshow_Genre;
use PDO;

class TvShowGenreCollection
{
    /**
     * Cette méthode retourne une liste des épisodes correspondant à l'id de la saison passé en paramètre
     * @param int $seasonId
     * @return array
     */

    public static function findByTvshowId(int $showId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow_genre
            WHERE id = :id
        SQL
        );

        $stmt->execute([':id' => $showId]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow_Genre::class);
        return $stmt->fetchAll();
    }
}