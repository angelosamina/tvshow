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
        <form name="filters" method="GET" action="check.php" >
    HTML
);
foreach ($stmt as $res) {
    $id = $res->getId();
    $name = AppWebPage::escapeString($res->getName());
    $webPage->appendContent(
        <<<HTML
            <label>
                <input name="id" type="checkbox" value="$id">
                $name
            </label>
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
            <button type="submit">Envoyer</button>				
        </form>
    HTML
);

echo $webPage->toHTML();
