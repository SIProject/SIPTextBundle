<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\MappedSuperclass
 */
class Text
{
    /**
     * @MongoDB\String
     */
    protected $title;

    /**
     * @MongoDB\String
     */
    protected $body;

    /**
     * @MongoDB\String
     */
    protected $slug;

    /**
     * @MongoDB\Boolean
     */
    protected $disabled = false;

    /**
     * Set title
     *
     * @param string $title
     * @return Text
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Text
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Text
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return Text
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getTitle();
    }
}