<?php

namespace QI\SistemaDeChamados\Model;

class Call{
    private $id;
    private $user_name;
    private $user_email;
    private $pc_number;
    private $floor;
    private $room;
    private $classification;
    private $description;
    private $note;

    public function __get($attribute){
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }

    public function __construct($user_name,$user_email,$pc_number,$floor,$room,$classification,$description){
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->pc_number = $pc_number;
        $this->floor = $floor;
        $this->room = $room;
        $this->classification = $classification;
        $this->description = $description;
    }
}