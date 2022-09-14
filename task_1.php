<?php
class TelegraphText 
{
    public $title; 
    public $text;
    public $author; 
    public $published; 
    public $slug; 

    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date('Y-m-d H:i:s');
    }

    public function storeText()
    {
        $storeText = [
            'text' => $this->text, 
            'title' => $this->title, 
            'author' => $this->author, 
            'published' => $this->published
        ];
        $serialize = serialize($storeText);
        // данные, которые храняться в serialize нужно поместить в файл чье имя храниться в slug
        file_put_contents($this->slug, $serialize);
    }

    public function loadText()
    {
    // получаем данные, которые хранться в файле, чье имя храниться в slug
        $serialize = file_get_contents($this->slug);
        if ($serialize != null) {
            $array = unserialize($serialize);
            $this->author = $array['author'];
            $this->text = $array['text'];
            $this->title = $array['title'];
            $this->published = $array['published'];
            return $this->text;
        } else {
            return false;
        }
    }
    
    public function editText($text, $title)
    {
        $this->text = $text;
        $this->title = $title;
    }
}
$TelegraphText = new TelegraphText('viktor', 'textclass.txt');
$TelegraphText->editText('hi', 'text');
$TelegraphText->storeText();
var_dump($tg->loadText());
