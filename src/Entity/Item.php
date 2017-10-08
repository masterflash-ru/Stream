<?php
namespace Stream\Entity;
/*
`id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` char(5) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL COMMENT 'ID юзера-владельца',
  `category` char(50) DEFAULT NULL,
  `date_public` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'дата публикации',
  `full` text COMMENT 'полностью новости',
  `caption` char(255) NOT NULL COMMENT 'заголовок',
  `alt` char(255) DEFAULT NULL COMMENT 'подпись на плашках, ALT',
  `anons` text COMMENT 'анонс новости',
  `url` char(255) DEFAULT NULL,
  `public` int(11) DEFAULT NULL COMMENT '1- публиковать',
  `title` char(254) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` text,
  `counter` int(11) DEFAULT '0' COMMENT 'счетчик просмотров',
  */

class Item
{
	protected $id;
	protected $locale;
	protected $owner;
	protected $category;
	protected $date_public;
	protected $full;
	protected $caption;
	protected $alt;
	protected $anons;
	protected $url;
	protected $public;
	protected $title;
	protected $keywords;
	protected $description; 
	protected $counter;



public function setId($id)
{
	$this->id=$id;
}

public function getId()
{
	return $this->id;
}
//-------
public function setLocale($locale)
{
	$this->locale=$locale;
}

public function getLocale()
{
	return $this->locale;
}
//-------
public function setOwner($owner)
{
	$this->owner=$owner;
}

public function getOwner()
{
	return $this->owner;
}
//-------
public function setCategory($category)
{
	$this->category=$category;
}

public function getCategory()
{
	return $this->category;
}
//-------
public function setDate_public($date_public)
{
	$this->date_public=$date_public;
}

public function getDate_public()
{
	return $this->date_public;
}
//-------
public function setFull($full)
{
	$this->full=$full;
}

public function getFull()
{
	return $this->full;
}
//-------
public function setCaption($caption)
{
	$this->caption=$caption;
}

public function getCaption()
{
	return $this->caption;
}
//-------
public function setAlt($alt)
{
	$this->alt=$alt;
}

public function getAlt()
{
	return $this->alt;
}
//-------
public function setAnons($anons)
{
	$this->anons=$anons;
}

public function getAnons()
{
	return $this->anons;
}
//-------
public function setUrl($url)
{
	$this->url=$url;
}

public function getUrl()
{
	return $this->url;
}
//-------
public function setPublic($public)
{
	$this->public=$public;
}

public function getPublic()
{
	return $this->public;
}
//-------
public function setTitle($title)
{
	$this->title=$title;
}

public function getTitle()
{
	return $this->title;
}
//-------
public function setKeywords($keywords)
{
	$this->keywords=$keywords;
}

public function getKeywords()
{
	return $this->keywords;
}
//-------
public function setDescription($description)
{
	$this->description=$description;
}

public function getDescription()
{
	return $this->description;
}
//-------
public function setCounter($counter)
{
	$this->counter=$counter;
}

public function getCounter()
{
	return $this->counter;
}

}
