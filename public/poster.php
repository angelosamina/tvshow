<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;

$webPage = new AppWebPage();

try {
    if (isset($_GET['posterId'])==false) {
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
    exit();
}

try {
    if (ctype_digit($_GET['posterId'])==false) {
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
    exit();
}

settype($_GET['posterId'], "int");
try {
    $cover = \Entity\Poster::findById($_GET['posterId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}

header("Content-Type: image/jpeg");

echo("{$cover->getJpeg()}");
