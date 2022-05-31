<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');

$stmt = Collection\TvshowCollection::findAll();


foreach ($stmt as $res) {
    $name = AppWebPage::escapeString($res->getName());
    $posterId = $res->getPosterId();
    $overview = AppWebPage::escapeString($res->getOverview());
    $webPage->appendContent(
        <<<HTML
        <album>
            <tvShow__cover><img src="poster.php?posterId=$posterId"></tvShow__cover>
            <main>
                <tvShow__name>$name</tvShow__name>
                <tvShow__overview>$overview</tvShow__overview>
            </main>
        </album>
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
    </list>
    HTML
);


echo $webPage->toHTML();
