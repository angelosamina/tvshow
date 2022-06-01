<?php

declare(strict_types=1);

namespace Entity;

use Entity\Collection\GenreCollection;

class Tvshow_Genre
{
    private int $id;
    protected int $genreId;
    protected int $tvShowId;

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
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getGenres(int $tvShowId): array
    {
        return GenreCollection::findByTvshowId($this->$tvShowId);
    }
}
