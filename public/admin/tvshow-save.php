<?php

declare(strict_types=1);

use Exception\ParameterException;

try{
    if (($_POST['name'] == '') || (isset($_POST['name'])==False)) {
        throw new ParameterException("Name invalide");
    }
}catch (ParameterException){
    http_response_code(400);
}

try{
    if (($_POST['originalName'] == '') || (isset($_POST['originalName'])==False)) {
        throw new ParameterException("originalName invalide");
    }
}catch (ParameterException){
    http_response_code(400);
}

try{
    if (($_POST['homepage'] == '') || (isset($_POST['homepage'])==False)) {
        throw new ParameterException("homepage invalide");
    }
}catch (ParameterException){
    http_response_code(400);
}

try{
    if (($_POST['overview'] == '') || (isset($_POST['overview'])==False)) {
        throw new ParameterException("overview invalide");
    }
}catch (ParameterException){
    http_response_code(400);
}


$tvshow = new \Html\Form\TvshowForm();
$tvshow -> setEntityFromQueryString();
$tvshow->getTvshow()->save();
header("Location: /index.php");
