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

    static function currentCompany(){
        if(Auth::isLogin()){
            $result = (new User())->getCompanyOfUser(Auth::currentUser()['id']);
            while ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return null;
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
            return true;
        }
        return false;
    }


    static function currentUser(){
        if (Auth::isLogin()) {
            return $_SESSION['user'];
        }
        return null;
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
