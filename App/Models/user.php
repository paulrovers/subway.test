<?php

namespace App\Models;

class user extends \Core\ModelObject
{
    public $id;
    public $name;
    public $email;
    public $password_hash;
    public $password_reset_hash;
    public $password_reset_expires_at;
    public $activation_hash;
    public $is_active;

    function __construct()
    {
        parent::SetTable('users');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('name');
        parent::AddField('email');
        parent::AddField('password_hash');
        parent::AddField('password_reset_hash');
        parent::AddField('password_reset_expires_at');
        parent::AddField('activation_hash');
        parent::AddField('is_active');
    }

    public static function getByEmail($email)
    {
        $user = new user();
        $data =  $user->Get($email, 'email');
        return $data;
    }
	
    public static function getById($id)
    {
        $user = new user();
        $data = $user->Get($id, 'id');
        return $data;
    }

	public static function CheckUser($email,$pass)
	{
		//check of email adres bestaat en ophalen hash als dat zo is
		$sql = sprintf('SELECT * FROM `users` WHERE `email` = \'%s\' LIMIT 1;', addslashes($email));
		$res = parent::dbQuery($sql);
		if (mysqli_num_rows($res) == 0){
			return false;
        }else{
			$data = mysqli_fetch_assoc($res);
			
			if(password_verify($pass,$data['password_hash'])){
				$user = new user();
				$user->SetFieldsFromArray($data);
				return $user;
			}else{
				return false;
			}
		}
		//create hash
		//$options = ['cost' => 14];
		//$hash = password_hash($hash,PASSWORD_BCRYPT, $options);
	}
	
	public static function saveUser($form)
	{
		$user = new user();
		$user->id = $form['id'];
		$user->name = $form['naam'];
		$user->email = $form['email'];
		$user->Save();
		return true;
	}
	
	public static function savePass($form)
	{
		//create hash
		$options = ['cost' => 14];
		$hash = password_hash($form['password_hash'],PASSWORD_BCRYPT, $options);
		
		//save password hash
		$user = new user();
		$user->id = $form['id'];
		$user->password_hash = $hash;
		$user->Save();
		return true;
	}
	
} 