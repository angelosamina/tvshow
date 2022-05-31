<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\AppWebPage;
use Entity\Collection;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');

$stmt = Collection\TvshowCollection::findAll();

$webPage->appendContent(
    <<<HTML
    <list>
    HTML
);


$test = 0;

foreach ($stmt as $res) {
    $test += 1;
    $name = AppWebPage::escapeString($res->getName());
    $posterId = $res->getPosterId();
    $overview = AppWebPage::escapeString($res->getOverview());
    $webPage->appendContent(
        <<<HTML
        <show>
            <tvShow__cover id=$test><img src="poster.php?posterId=$posterId"></tvShow__cover>
            <main>
                <tvShow__name>$name</tvShow__name>
                <tvShow__overview>$overview</tvShow__overview>
            </main>
        </show>
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
    </list>
    HTML
);

echo $webPage->toHTML();
