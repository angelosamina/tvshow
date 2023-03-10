<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\Tvshow;
use Html\AppWebPage;
use Html\WebPage;

$webPage = new AppWebPage();

if (!isset($_GET['seasonId']) || !ctype_digit($_GET['seasonId'])) {
    header("Location: http://localhost:8000/index.php");
    exit();
}

settype($_GET['seasonId'], "int");
try {
    $season = Season::findById($_GET['seasonId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}

$season = Season::findById($_GET['seasonId']);

$tvshow = Tvshow::findById($season->getTvShowId());

$showTitle = \Html\WebPage::escapeString($tvshow->getName());
$seasonTitle = \Html\WebPage::escapeString($season->getName());
$showId =$tvshow->getId();


$webPage->setTitle(
    <<<HTML
        Série TV : $showTitle
        $seasonTitle
    HTML
);

$idSeason = $season->getId();
$seasonPosterId = $season->getPosterId();

$webPage->appendContent(
    <<<HTML
    <list>
    HTML
);
$webPage->appendContent(
    <<<HTML
        <season>
                <saison__cover><img src="poster.php?posterId=$seasonPosterId"></saison__cover>
                <div class="box">
                    <a id="show__link" href="serie.php?serieId=$showId">$showTitle</a> 
                    <saison__titre>$seasonTitle</saison__titre>
                </div>
        </season>
    HTML
);

$episodes = $season->getEpisodes();

foreach ($episodes as $res) {
    $title = WebPage::escapeString($res->getName());
    $episodeNumber = $res->getEpisodeNumber();
    $overview = WebPage::escapeString($res->getOverview());
    $webPage->appendContent(
        <<<HTML
        <div class="episode">
            <main>
                <p>$episodeNumber - $title <br>
                   $overview
                </p>
            </main>
        </div>
    HTML
    );
}
$webPage->appendContent(
    <<<HTML
    </list>
HTML
);
echo $webPage->toHTML();
