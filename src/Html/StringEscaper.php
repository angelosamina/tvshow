<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * @param string $string
     * @return string
     */
    public static function escapeString(?string $string=null): ?string
    {
        $chaine = htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, "UTF-8");
        return $chaine;
    }

    public static function striptagsAndTrim(?string $string=null): ?string
    {
        $chaine = strip_tags($string);
        $chaine = trim($chaine);

        return $chaine;
    }
}