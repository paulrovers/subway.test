<?php

namespace Core;

use PDO;
use App\Config;


class Model
{

     private $resLastResource;

     /**
      * Connect to database with given credentials
      * @param string Hostname
      * @param string Username
      * @param string Password
      * @param string Database
      * @return void
      */

    public static function Connect()
    {
        try
        {
            if (!@mysqli_connect(Config::DB_HOST,Config::DB_USER,Config::DB_PASSWORD,Config::DB_NAME))
            {
                $connectivity = mysqli_connect(Config::DB_HOST,Config::DB_USER,Config::DB_PASSWORD,Config::DB_NAME);
                throw new Exception(mysqli_error($connectivity));
            }
            else{

                return $connectivity = mysqli_connect(Config::DB_HOST,Config::DB_USER,Config::DB_PASSWORD,Config::DB_NAME);
            }

        }
        catch (Exception $strError)
        {
            Error::SystemFailure($strError, true, true);
        }
    }
}
