<?php

namespace Html;

class WebPage
{
    private string $head;
    private string $title;
    private string $body;

    /**
     * @param string $title
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $content
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * @param string $css
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style>$css</style>";
    }

    /**
     * @param string $url
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link href='$url' rel='stylesheet'>";
    }

    /**
     * @param string $js
     */
    public function appendJs(string $js): void
    {
        $this->head .= <<<JS
        <script>
            $js
        </script>
        JS;
    }

    /**
     * @param string $url
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= <<<JS
        <script src ="$url"></script>
        JS;
    }

    /**
     * @param string $url
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * @return string
     */
    public function toHTML(): string
    {
        $html = "<!doctype html> 
                 <html lang=&ldquo;fr&rdquo;> 
                   <head>$this->head
                        <meta charset=&ldquo;utf-8&rdquo;>
                        <meta name='viewport'>
                        <title>$this->title</title>
                   </head>
                    <body>$this->body</body>
                    </html>";
        return $html;
    }

    /**
     * @return string
     */
    public function getLastModification(): string
    {
        $res = "Dernière modification : " . date("F d Y H:i:s.", getlastmod());
        return $res;
    }

    /**
     * @return string
     */
    public static function escapeString(string $string)
    {
        return htmlspecialchars($string, ENT_XML1 | ENT_QUOTES);
    }
}
