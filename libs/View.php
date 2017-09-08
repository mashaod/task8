<?php

class View
{
    private $string = "";
    private $file;

    public function __construct($template)
    {       
        $this->file = file_get_contents($template);
    }

    public function createString($data)
    {
        for ($i=count($data[title]); $i>=0; $i--)
        {
            $this->string .= "<div style=\"margin-left:10px\">";
            $this->string .= "<div class=\"list-group\">";
            $this->string .= "<h4 class=\"list-group-item-heading\">" . $data[title][$i] . "</h4>";
            $this->string .= "<a href=\"" . $data[url][$i] . "style=\"color:green\">" . $data[url][$i] . "</a>"; 
            $this->string .= "<p class=\"list-group-item-text\">" . $data[text][$i] . "</p>";
            $this->string .= "</div></div>"; 
        }
    }

    public function createTemplate()
    {
        $this->file = str_replace('%LIST%', $this->string, $this->file);
        echo $this->file;
    }
}
