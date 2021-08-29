<?php

require_once('AbstractEntity.php');

class Member extends AbstractEntity
{
    private $_id;
    private $_member_name;
    private $_password;
    private $_role;

    // SETTER
    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setMember_name($member_name)
    {
        $this->_member_name = $member_name;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setRole($role)
    {
        $this->_role = $role;
    }

    // GETTER
    public function getId()
    {
        return $this->_id;
    }

    public function getMember_name()
    {
        return $this->_member_name;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getRole()
    {
        return $this->_role;
    }
}
