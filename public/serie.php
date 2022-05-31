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
        Albums de $titre
    HTML
);
$webPage->appendContent(
    <<<HTML
    <list>
    HTML
);

$saisons = $tvshow->getSaisons();

foreach ($saisons as $res) {
    $poster = $res->getPosterId();
    $titre = WebPage::escapeString($res->getName());
    $tvshowId = $res->getTvshowId();
}
