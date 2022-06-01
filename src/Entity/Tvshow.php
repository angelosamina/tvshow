<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Tvshow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    protected ?int $posterId;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Tvshow
     */
    private function setId(?int $id): Tvshow
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Tvshow
     */
    public function setName(string $name): Tvshow
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return Tvshow
     */
    public function setOriginalName(string $originalName): Tvshow
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     * @return Tvshow
     */
    public function setHomepage(string $homepage): Tvshow
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return Tvshow
     */
    public function setOverview(string $overview): Tvshow
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * @param int|null $posterId
     * @return Tvshow
     */
    public function setPosterId(?int $posterId): Tvshow
    {
        $this->posterId = $posterId;
        return $this;
    }


    public static function findById(int $id): Tvshow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow
            WHERE id = :id
            ORDER BY name
        SQL
        );

        $stmt->execute([':id' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        $tvshow = $stmt->fetch();
        if ($tvshow == false) {
            throw new EntityNotFoundException("L'id saisi n'est pas présent dans la base de données");
        } else {
            return $tvshow;
        }
    }

    public function getSeason(): array
    {
        return SeasonCollection::findByShowId($this->id);
    }
}
