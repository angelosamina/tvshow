<?php
declare(strict_types=1);

use Entity\Collection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$webPage->setTitle(
    <<<HTML
        Filtres
    HTML
);

$stmt = Collection\GenreCollection::findAll();

$webPage->appendContent(
    <<<HTML
        <form class="form" name="filters" method="GET" action="index.php" >
    HTML
);
foreach ($stmt as $res) {
    $id = $res->getId();
    $name = AppWebPage::escapeString($res->getName());
    $webPage->appendContent(
        <<<HTML
            <label>
                <input name="genreId" type="radio" value="$id">
                $name
            </label>
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
            <button class="form_button" type="submit">Valider</button>				
        </form>
    HTML
);

echo $webPage->toHTML();
