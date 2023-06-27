<?php

namespace App\Models;

class pages extends \Core\Model
{
    public function GetPageByUrl(string $url):mixed
    {
        $query = "SELECT * FROM pages WHERE url = :url";
        $array = ['url' => $url];
        $result = $this->dbQuery($query,$array);

        if(count($result) > 0){
            return $result[0];
        }else{
            return false;
        }
    }
}