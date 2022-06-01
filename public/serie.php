<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Html\AppWebPage;
use Html\WebPage;

$webPage = new AppWebPage();

if (!isset($_GET['serieId']) || !ctype_digit($_GET['serieId'])) {
    header("Location: http://localhost:8000/index.php");
    exit();
}

settype($_GET['serieId'], "int");
try {
    $tvshow = Tvshow::findById($_GET['serieId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}


$titre = \Html\WebPage::escapeString($tvshow->getName());

$webPage->setTitle(
    <<<HTML
        Série TV : $titre
    HTML
);

$idTvshow = $tvshow->getId();
$originalTitre = WebPage::escapeString($tvshow->getOriginalName());
$desc = WebPage::escapeString($tvshow->getOverview());
$posterTv = $tvshow->getPosterId();

$webPage->appendContent(
    <<<HTML
    <list>
    HTML
);
$webPage->appendContent(
    <<<HTML
        <a>
            <saison__cover><img src="poster.php?posterId=$posterTv"></saison__cover>
            <main>
                <saison__titre>$titre</saison__titre>
                <saison__Otitre>$originalTitre</saison__Otitre>
                <saison__overview>$desc</saison__overview>
            </main>
        </a>
    HTML
);

$saisons = $tvshow->getSeason();

foreach ($saisons as $res) {
    $posterId = $res->getPosterId();
    $titreS = WebPage::escapeString($res->getName());
    $webPage->appendContent(
        <<<HTML
        <a class="saison">
            <saison__cover><img src="poster.php?posterId=$posterId"></saison__cover>
            <main>
                <saison__titre>$titreS</saison__titre>
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
