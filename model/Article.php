<?php

//entity Article
class Article extends AbstractEntity
{
    private $_id;
    private $_title;
    private $_date;
    private $_author;
    private $_content;

    // SETTER
    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function setDate($date)
    {
        $this->_date = $date;
    }

    public function setAuthor($author)
    {
        $this->_author = $author;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }

    // GETTER
    public function getId()
    {
        return $this->_id;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getContent()
    {
        return $this->_content;
    }

}
