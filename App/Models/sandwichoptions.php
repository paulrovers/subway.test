<?php

namespace App\Models;

class sandwichoptions extends \Core\ModelObject
{
    public $id;
    public $type;
    public $options;

    function __construct()
    {
        parent::SetTable('sandwichoptions');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('type');
        parent::AddField('options');
    }

    public static function getSandwichOptionData($value, $field='')
    {
        $sandwichoption = new sandwichoptions();
        return $sandwichoption->Get($value, $field);
    }

    public static function getSandwiches()
    {
        $sandwichoptions = new sandwichoptions();
        return $sandwichoptions->GetAll();
    }

}