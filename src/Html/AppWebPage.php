<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->appendCssUrl('/css/style.css');
    }

    public function toHTML(): string
    {
        $html = <<<HTML
    <!Doctype html>
    <html lang='fr'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            {$this->head}
            <title> {$this->title}</title>
        <header>
            <h1>{$this->title}</h1>
            <a class="button" href="http://localhost:8000/index.php"><img src="https://icon-library.com/images/home-button-icon-png/home-button-icon-png-10.jpg"></a>
            <a class="filters" href="http://localhost:8000/filters.php"><img src="https://icon-library.com/images/filters-icon/filters-icon-19.jpg"></a>
        </header>
        <content>
            {$this->body}
        </content>
        <footer>{$this->getLastModification()}</footer>
    </html>
    HTML;

        return $html;
    }
}
