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

    public function __construct()
    {
    }


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

    public function delete(): Tvshow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            DELETE FROM tvshow
            WHERE id = :id;
        SQL
        );

        $stmt->execute([':id' => $this->getId()]);

        $this->setId(null);

        return $this;
    }

    protected function update(): Tvshow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            UPDATE tvshow
            SET name = :name, originalName = :originalName, homepage = :homepage, overview = :overview, posterId = :posterId
            WHERE id = :id;            
        SQL
        );

        $stmt->execute([':name' => $this->getName(),
            ':originalName' => $this->getOriginalName(),
            ':homepage' => $this->getHomepage(),
            ':overview' => $this->getOverview(),
            ':posterId' => $this->getPosterId(),
            ':id' => $this->getId()]);

        return $this;
    }

    public static function create(string $name, string $originalName, string $homepage, string $overview, int $posterId, ?int $id=null): Tvshow
    {
        $res = new Tvshow();
        $res->setName($name);
        $res->setId($id);
        $res->setHomepage($homepage);
        $res->setOriginalName($originalName);
        $res->setOverview($overview);
        $res->setPosterId($posterId);


        return $res;
    }

    protected function insert(): Tvshow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            INSERT INTO Tvshow
            VALUES (:id, :name, :originalName, :homepage, :overview, :posterId);
        SQL
        );

        $stmt->execute([':id' => $this->getId(),
            ':name' => $this->getName(),
            ':originalName' => $this->getOriginalName(),
            ':homepage' => $this->getHomepage(),
            ':overview' => $this->getOverview(),
            ':posterId' => $this->getPosterId()]);

        $res = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id
            FROM Tvshow
            WHERE name = :name;
        SQL
        );

        $res->execute([':name' => $this->getName()]);
        $res->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        $tvshow = $res->fetch();

        $this->setId($tvshow->getId());

        return $this;
    }

    public function save(): Tvshow
    {
        if (is_null($this->getId())==true) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this;
    }
}
