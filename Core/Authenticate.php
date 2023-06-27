<?php

namespace Core;

use App\Models\user;

class Authenticate
{
    public static function login(array $user)
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
    }

    public static function loginLink($sessionvars)
    {
        session_regenerate_id(false);
        $_SESSION['order_id'] = $sessionvars['order_id'];
        $_SESSION['client_id'] = $sessionvars['client_id'];
        $_SESSION['client_name'] = $sessionvars['client_name'];
        $_SESSION['order'] = false;
    }
    
    public static function logout()
    {
        // Unset all of the session variables
        $_SESSION = [];
            
        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? '/';
    }

    public function getUser()
    {
        if (isset($_SESSION['user_id'])) {
            $userObj = new user();
            return $userObj->getById($_SESSION['user_id']);
        }else{
            return false;
        }
    }
}
