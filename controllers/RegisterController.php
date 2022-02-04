<?php
require_once "BaseController.php";
require_once "../models/User.php";
require_once "LoginController.php";

class RegisterController extends BaseController
{
    function register($post_data)
    {
        $message = [];
        $is_valid = true;
        // required validation
        $result =  Validators::required([
            'First Name' => $post_data['firstName'],
            'Last Name' => $post_data['lastName'],
            'Address' => $post_data['address'],
            'City' => $post_data['city'],
            'Country' => $post_data['country'],
            'Postal' => $post_data['postal'],
            'Phone' => $post_data['phone'],
            'Email' => $post_data['email'],
            'Password' => $post_data['password'],
            'Password Confirmation' => $post_data['password_confirmation'],
        ]);
        if (!$result['is_valid']) {
            $is_valid = $is_valid && $result['is_valid'];
            $message = array_merge($message,$result['message']);
        }
        // email validation
        $result = Validators::userEmailUnique($post_data['email']);
        if (!$result['is_valid']) {
            $is_valid = $is_valid && $result['is_valid'];
            $message = array_merge($message,$result['message']);
        }
        // password validation
        $result = Validators::twoFieldsMatch(
            ['Password'=>$post_data['password']],
            ['Password Confirmation'=>$post_data['password_confirmation']]
        );
        if (!$result['is_valid']) {
            $is_valid = $is_valid && $result['is_valid'];
            $message = array_merge($message,$result['message']);
        }


        // if invalid return with errors
        if(!$is_valid){
            return ['success'=>$is_valid,"message"=>$message];
        }

        // if valid then add the user details.
        $user = new User();
        $travel_user = [];
        $travel_user['username'] = $post_data['email'];
        $travel_user['pass'] = $post_data['password'];
        // just following the trend on database and keeping the value as 1
        // no idea about what this field is about 
        $travel_user['state'] = 1;
        // current date time as default value for these two fields
        $travel_user['datejoined'] = date('Y-m-d H:i:s');
        $travel_user['datelastmodified'] = date('Y-m-d H:i:s');

        // travel user details
        $travel_user_details = $post_data;
        unset($travel_user_details['password_confirmation']);
        unset($travel_user_details['password']);
        // privacy 2 for customer and 1 for admin
        $travel_user_details['privacy'] = 2;
        if($user->addUser($travel_user,$travel_user_details)){
            // login if the registration is successful
            $login_controller = new LoginController();
            // this will automatically redirect the user after the successful login
            // if error then the error msg will be displayed
            $result = $login_controller->login(['username'=>$post_data['email'],'password'=>$post_data['password']]);
            if(!$result['success']){
                return ['success'=>false,"title"=>"Registered but could not login automatically.","message"=>$result['message']];
            }            
        }
        return ['success'=>false,"title"=>"Could not register user.","message"=>["Some error occured on user model."]];

    }
}
