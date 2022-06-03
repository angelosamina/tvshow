<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
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

    public static function findByGenreId(int $genre): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow
            WHERE id IN (
                                SELECT tvShowId
                                FROM tvshow_genre
                                WHERE genreId = :genre
            )
            ORDER BY name;
        SQL
        );

        $stmt->execute([':genre' => $genre]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        return $stmt->fetchAll();
    }
}
