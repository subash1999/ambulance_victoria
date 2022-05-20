<?php
require_once "BaseController.php";
require_once "../models/User.php";


class LoginController extends BaseController
{
    function login($post_data)
    {
        $username = $post_data['username'];
        $password = $post_data['password'];
        $message = [];
        $result =  Validators::required(['Email' => $username, 'Password' => $password]);
        if (!$result['is_valid']) {
            return ['success' => false, 'message' => $result['message']];
        }
        $user = new User();
        $query = "
        SELECT
            *
        FROM
            user
        WHERE
            username = '$username' AND PASS = '$password';
        ";
        $result = $user->executeQuery($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            Auth::storeAuthDetails($row);
            Alert::setAlertMessage("Logined Successfully.","Success");

            echo '<script>

            window.location="/";

            </script>';

            // go to the homepage index.php after login
            // header("Location: /");

            // return ["success"=>true,"msg"=>'logined'];
        } else {
            array_push($message, "Invalid Login Credentials Provided.");
        }
        return ["success" => false, "message" => $message];
    }

    function logout()
    {
        Auth::clearUserDetails();
        echo '<script>
        window.location="/";
        </script>';
    }
}
