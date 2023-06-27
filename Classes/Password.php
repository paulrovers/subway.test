<?php

namespace Classes;

Class Password{
	
	private $password = '';

    public function generate($length = 8)
	{
		$chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
		
		for($i = 0; $i < $length; $i++)
		{
			$this->password .= $chars[rand(0, strlen($chars)-1)];
		}
		
		return $this->password;
	}
}


?>