<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');

$stmt = Collection\TvshowCollection::findAll();

$webPage->appendContent(
    <<<HTML
    <list>
HTML
);

foreach ($stmt as $res) {
    $id = $res->getId();
    $nom = WebPage::escapeString($res->getName());
    $webPage->appendContent(
        <<<HTML
        <a href="/season.php?id=$id">$nom</a>\n
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
    </list>
HTML
);

echo $webPage->toHTML();
