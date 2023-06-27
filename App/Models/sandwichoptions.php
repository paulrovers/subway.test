<?php

namespace App\Models;

class sandwichoptions extends \Core\Model
{
    public function getSandwichOptions()
    {
        $query = "SELECT * FROM sandwichoptions";
        $array = [];
        $result = $this->dbQuery($query,$array);
        return $result;
    }
}