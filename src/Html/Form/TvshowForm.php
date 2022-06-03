<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;
use Exception\ParameterException;
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

    public function setEntityFromQueryString(): void
    {
        if ((isset($_POST['id'])==false) || (ctype_digit($_POST['id'])==false)) {
            $tvshowId = null;
        } else {
            $tvshowId = $_POST['id'];
            settype($tvshowId, "int");
        }

        if ((isset($_POST['name'])) && $_POST['name'] != "") {
            $name = self::striptagsAndTrim($_POST['name']);
        } else {
            throw new ParameterException("Name non défini");
        }

        if ((isset($_POST['originalName'])) && $_POST['originalName'] != "") {
            $originalName = self::striptagsAndTrim($_POST['originalName']);
        } else {
            throw new ParameterException("originalName non défini");
        }

        if ((isset($_POST['homepage'])) && $_POST['homepage'] != "") {
            $homepage = self::striptagsAndTrim($_POST['homepage']);
        } else {
            throw new ParameterException("homepage non défini");
        }

        if ((isset($_POST['overview'])) && $_POST['overview'] != "") {
            $overview = self::striptagsAndTrim($_POST['overview']);
        } else {
            throw new ParameterException("overview non défini");
        }

        if ((isset($_POST['posterId'])==false) || (ctype_digit($_POST['posterId'])==false)) {
            $posterId = null;
        } else {
            $posterId = $_POST['id'];
            settype($posterId, "int");
        }



        $artist = Tvshow::create($name, $originalName, $homepage, $overview, $posterId, $tvshowId);

        $this->artist = $artist;
    }
}
