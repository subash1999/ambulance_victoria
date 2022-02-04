<?php
class Auth
{
    static function storeAuthDetails($user)
    {
        $_SESSION['user'] = $user;
    }

    static function clearUserDetails(){
        unset($_SESSION['user']);
    }
    static function isGuest()
    {
        return !isset($_SESSION['user']);
    }

    static function isLogin()
    {
        return isset($_SESSION['user']);
    }

    static function isAdmin()
    {
        if (Auth::isLogin()) {
            return $_SESSION['user']['Privacy'] == 1;
        }
        return false;
    }

    static function isUser()
    {
        if (Auth::isLogin()) {
            return $_SESSION['user']['Privacy'] == 2;
        }
        return false;
    }

    static function currentUser(){
        if (Auth::isLogin()) {
            return $_SESSION['user'];
        }
        return null;
    }

    static function userGuard(){
        if(!Auth::isUser()){
            echo '<script>

            window.location="/views/login.php";

            </script>';
        }
    }

    static function guestGuard(){
        if(!Auth::isGuest()){
            echo '<script>

            window.location="/";

            </script>';
        }
    }

    static function adminGuard(){
        if(!Auth::isAdmin()){
            echo '<script>

            window.location="/views/login.php";

            </script>';
        }
    }
}
