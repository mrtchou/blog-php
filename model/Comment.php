<?php require_once('AbstractEntity.php');


class Comment extends AbstractEntity
{
    private $_id;
    private $_post_id;
    private $_name;
    private $_comment;
    private $_date;
    private $_validation;

    // SETTER
    public function setId($id)
    {
      $this->_id = $id;
    }

    public function setPost_id($post_id)
    {
      $this->_post_id = $post_id;
    }

    public function setName($name)
    {
      $this->_name = $name;
    }

    public function setComment($comment)
    {
      $this->_comment = $comment;
    }

    public function setComment_date($date)
    {
      $this->_date = $date;
    }

    public function setValidation($validation)
    {
      $this->_validation = $validation;
    }

    // GETTER
    public function getId()
    {
      return $this->_id;
    }

    public function getPost_id()
    {
      return $this->_post_id;
    }

    public function getName()
    {
      return $this->_name;
    }

    public function getComment()
    {
      return $this->_comment;
    }

    public function getDate()
    {
      return $this->_date;
    }

    public function getValidation()
    {
      return $this->_validation;
    }
}
