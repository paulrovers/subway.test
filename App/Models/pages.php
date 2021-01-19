<?php

namespace App\Models;

class pages extends \Core\ModelObject
{
    public $id;
    public $title;
    public $html_content;
    public $url;
    public $category_id;
    public $meta_description;
    public $meta_title;
    public $name;

    function __construct()
    {
        parent::SetTable('pages');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('title');
        parent::AddField('html_content');
        parent::AddField('url');
        parent::AddField('category_id');
        parent::AddField('meta_description');
        parent::AddField('meta_title');
        parent::AddField('name');

    }

}