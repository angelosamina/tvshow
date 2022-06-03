<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

if (isset($_GET['tvshowId']) == false) {
    $tvshow = null;
} else {
    try {
        if (ctype_digit($_GET['tvshowId']) == false) {
            throw new ParameterException("Id invalide");
        }
    } catch (ParameterException) {
        http_response_code(400);
        exit();
    }

    settype($_GET['tvshowId'], "int");
    try {
        $tvshow = \Entity\Tvshow::findById($_GET['tvshowId']);
    } catch (EntityNotFoundException $except) {
        http_response_code(404);
        exit();
    }
}
$tvshowForm = new \Html\Form\TvshowForm($tvshow);

$form = $tvshowForm->getHtmlForm("tvshow-save.php");

$webPage = new \Html\AppWebPage();

$webPage->setTitle('Series TV');

$webPage->appendContent($form);

echo $webPage->toHTML();
