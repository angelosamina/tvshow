<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;

class TvshowForm
{
    private ?Tvshow $tvshow;

    /**
     * @param Tvshow|null $tvshow
     */
    public function __construct(?Tvshow $tvshow=null)
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

    public function getHtmlForm(string $action):string
    {
        $form = <<<HTML
        <form name="TvshowForm" method="post" action="$action">
            <label id="id">
                <input name="id" type="hidden">
            </label>
            <label id="Nom">
                Nom :
                <input name="name" type="text" placeholder="Name" required>
            </label>
            <label id="originalName">
                Nom original :
                <input name="originalName" type="text" placeholder="originalName" required>
            </label>
            <label id="homepage">
                Lien de l'homepage :
                <input name="homepage" type="url" placeholder="homepage" required>
            </label>
            <label id="overview">
                Résumé :
                <input name="overview" type="text" placeholder="overview" required>
            </label>
            <label id="posterId">
                Id de la photo :
                <input name="posterId" type="number" placeholder="posterId">
            </label>
            <button type="submit">Enregistrer</button>
        </form>
    HTML;

        return $form;
    }

}