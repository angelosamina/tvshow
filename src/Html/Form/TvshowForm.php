<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;
use Html\StringEscaper;

class TvshowForm
{
    use StringEscaper;

    private ?Tvshow $tvshow;

    /**
     * @param Tvshow|null $tvshow
     */
    public function __construct(?Tvshow $tvshow = null)
    {
        $this->tvshow = $tvshow;
    }

    /**
     * @return Tvshow|null
     */
    public function getTvshow(): ?Tvshow
    {
        return $this->tvshow;
    }

    public function getHtmlForm(string $action): string
    {
        if (is_null($this->tvshow) == true) {
            $id = "";
            $name = "";
            $originalName = "";
            $homepage = "";
            $overview = "";
            $posterId = "";
        } else {
            $id = $this->tvshow->getId();
            $name = self::escapeString($this->tvshow->getName());
            $originalName = self::escapeString($this->tvshow->getOriginalName());
            $homepage = self::escapeString($this->tvshow->getHomepage());
            $overview = self::escapeString($this->tvshow->getOverview());
            $posterId = $this->tvshow->getPosterId();
        }

        $form = <<<HTML
        <form name="TvshowForm" method="post" action="$action">
            <label id="id">
                <input name="id" type="hidden" value=$id>
            </label>
            <label id="Nom">
                Nom :
                <input name="name" type="text" value="$name" required>
            </label>
            <label id="originalName">
                Nom original :
                <input name="originalName" type="text" value="$originalName" required>
            </label>
            <label id="homepage">
                Lien de l'homepage :
                <input name="homepage" type="url" value="$homepage" required>
            </label>
            <label id="overview">
                Résumé :
                <input name="overview" type="text" value="$overview" required>
            </label>
            <label id="posterId">
                Id de la photo :
                <input name="posterId" type="number" value="$posterId">
            </label>
            <button type="submit">Enregistrer</button>
        </form>
    HTML;

        return $form;
    }
}
