<?php
namespace Mf\Stream\Entity;

class Item
{
protected $id = null;

    protected $locale = null;

    protected $owner = null;

    protected $category = null;

    protected $date_public = null;

    protected $full = null;

    protected $caption = null;

    protected $alt = null;

    protected $anons = null;

    protected $url = null;

    protected $public = null;

    protected $title = null;

    protected $keywords = null;

    protected $description = null;

    protected $counter = null;

    protected $lastmod = null;

    protected $seo_options = null;

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLocale($locale)
    {
        $this->locale=$locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setOwner($owner)
    {
        $this->owner=$owner;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setCategory($category)
    {
        $this->category=$category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDate_public($date_public)
    {
        $this->date_public=$date_public;
    }

    public function getDate_public()
    {
        return $this->date_public;
    }

    public function setFull($full)
    {
        $this->full=$full;
    }

    public function getFull()
    {
        return $this->full;
    }

    public function setCaption($caption)
    {
        $this->caption=$caption;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setAlt($alt)
    {
        $this->alt=$alt;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function setAnons($anons)
    {
        $this->anons=$anons;
    }

    public function getAnons()
    {
        return $this->anons;
    }

    public function setUrl($url)
    {
        $this->url=$url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setPublic($public)
    {
        $this->public=$public;
    }

    public function getPublic()
    {
        return $this->public;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setKeywords($keywords)
    {
        $this->keywords=$keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setDescription($description)
    {
        $this->description=$description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setCounter($counter)
    {
        $this->counter=$counter;
    }

    public function getCounter()
    {
        return $this->counter;
    }

    public function setLastmod($lastmod)
    {
        $this->lastmod=$lastmod;
    }

    public function getLastmod()
    {
        return $this->lastmod;
    }

    public function setSeo_options($seo_options)
    {
        $this->seo_options=$seo_options;
    }

    public function getSeo_options()
    {
        return $this->seo_options;
    }


}
