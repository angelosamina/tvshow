<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * @return int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId | null;
    }

    public static function findById(int $id): Season
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM season
            WHERE id = :id
            ORDER BY name
        SQL
        );

        $stmt->execute([':id' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Season::class);
        $season = $stmt->fetch();
        if ($season == false) {
            throw new EntityNotFoundException("L'id saisi n'est pas présent dans la base de données");
        } else {
            return $season;
        }
    }

    public function getEpisodes(): array
    {
        return EpisodeCollection::findBySeasonId($this->id);
    }
}
