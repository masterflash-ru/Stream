<?php
namespace Mf\Stream\Entity;


class SeoOptions
{
    protected $robots = null;

    protected $canonical = null;

    public function setRobots($robots)
    {
        $this->robots=$robots;
    }

    public function getRobots()
    {
        return $this->robots;
    }

    public function setCanonical($canonical)
    {
        $this->canonical=$canonical;
    }

    public function getCanonical()
    {
        return $this->canonical;
    }


}
