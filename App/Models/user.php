<?php

namespace App\Models;

class user extends \Core\Model
{
    /**
     * Get user account by email
     */
    public function getByEmail(string $email):array
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $array = ['email' => $email];
        $result = $this->dbQuery($query,$array);
        return $result[0];
    }

    /**
     * Get user account by id
     */
    public function getById(int $userId):array
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $array = ['id' => $userId];
        $result = $this->dbQuery($query,$array);
        return $result[0];
    }

    /**
     * Check if user exists
     */
	public function CheckUser(string $email,string $pass):mixed
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $array = ['email' => $email];
        $result = $this->dbQuery($query,$array);
        if (count($result) == 1){
            if(password_verify($pass,$result[0]['password_hash'])) {
                return $result[0];
            }
        }else{
            return false;
        }
		//create hash
		//$options = ['cost' => 14];
		//$hash = password_hash($hash,PASSWORD_BCRYPT, $options);
        return false;
	}

    /**
     * Update user data
     */
	public function saveUser(array $form):bool
	{
        $query = "UPDATE users SET `name` = :name, `email` = :email WHERE id = :id";
        $array = [
            'id' => $form['id'],
            'name' => $form['naam'],
            'email' => $form['email']
        ];
        $this->dbQuery($query,$array);
        return true;
	}

    /**
     * Update new password
     */
	public function savePass(array $form):bool
	{
		//create hash
		$options = ['cost' => 14];
		$hash = password_hash($form['password_hash'],PASSWORD_BCRYPT, $options);

        $query = "UPDATE users SET `password_hash` = :hash WHERE id = :id";
        $array = [
            'id' => $form['id'],
            'hash' => $hash
        ];
        $this->dbQuery($query,$array);
        return true;
	}
	
} 