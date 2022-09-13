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
		file_put_contents($this->slug, $serialize);//данные, которые храняться в serialize нужно поместить в файл чье имя храниться в slug
	}
	public function loadText()
	{
		$serialize = file_get_contents($this->slug);//получаем данные, которые хранться в файле, чье имя храниться в slug
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
	//САМ
	public function editText($text, $title)
	{
		$this->text = $text;
		$this->title = $title;
	}
}
$tg = new TelegraphText('viktor', 'textclass.txt');
$tg->editText('hi', 'text');
$tg->storeText();
var_dump($tg->loadText());