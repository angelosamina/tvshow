<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Poster
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Poster
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, jpeg
            FROM cover
            WHERE id = :id
        SQL
        );

        $stmt->execute([':id' => $id]);

        $stmt -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Cover::class);
        $poster =  $stmt->fetch();

        return $poster;
    }
}