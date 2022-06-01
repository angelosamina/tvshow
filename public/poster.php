<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;

$webPage = new AppWebPage();

try {
    if ((isset($_GET['posterId'])==false) || (ctype_digit($_GET['posterId'])==false)) {
        throw new ParameterException();
    }
} catch (ParameterException) {
    header("Location: /img/default.png");
    exit();
}

settype($_GET['posterId'], "int");
try {
    $poster = \Entity\Poster::findById($_GET['posterId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}

header("Content-Type: image/jpeg");

echo("{$poster->getJpeg()}");
