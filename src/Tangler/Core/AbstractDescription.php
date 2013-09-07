<?php

namespace Tangler\Core;

abstract class AbstractDescription
{
    private $key;
    private $status;
    private $label;
    private $description;
    private $imageurl;
    private $author;


    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getImageUrl()
    {
        if ($this->imageurl=='') {
            $this->imageurl = "http://www.paff.org/wp-content/themes/gonzo/images/no-image-blog-one.png";
        }
        return $this->imageurl;
    }

    public function setImageUrl($imageurl)
    {
        $this->imageurl = $imageurl;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
