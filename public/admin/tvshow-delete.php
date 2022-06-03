<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if (isset($_GET['tvshowId'])==false || ctype_digit($_GET['tvshowId'])==false) {
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
    exit();
}

settype($_GET['tvshowId'], "int");
try {
    $artist = \Entity\Tvshow::findById($_GET['tvshowId']);
} catch (EntityNotFoundException $except) {
    http_response_code(404);
    exit();
}

$artist->delete();
header("Location: index.php");
