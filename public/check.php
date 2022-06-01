<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Entity\Collection;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');

if (!isset($_GET['genreId']) || !ctype_digit($_GET['genreId'])) {
    header("Location: http://localhost:8000/index.php");
    exit();
}

settype($_GET['genreId'], "int");


try {
    $tvshow = Collection\TvshowCollection::findByGenreId($_GET['genreId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}


$webPage->setTitle(
    <<<HTML
        Resultat : 
    HTML
);

$webPage->appendContent(
    <<<HTML
    <list>
    HTML
);


$test = 0;

foreach ($tvshow as $res) {
    $test += 1;
    $id = $res->getId();
    $name = AppWebPage::escapeString($res->getName());
    $posterId = $res->getPosterId();
    $overview = AppWebPage::escapeString($res->getOverview());
    $webPage->appendContent(
        <<<HTML
        <a href="serie.php?serieId=$id">
            <tvShow__cover id=$test><img src="poster.php?posterId=$posterId"></tvShow__cover>
            <main>
                <tvShow__name>$name</tvShow__name>
                <tvShow__overview>$overview</tvShow__overview>
            </main>
        </a>
    HTML
    );
}

$webPage->appendContent(
    <<<HTML
    </list>
    HTML
);

echo $webPage->toHTML();
