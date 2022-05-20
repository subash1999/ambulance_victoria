<?php
require_once "BaseController.php";
require_once "../models/User.php";
require_once "LoginController.php";

class RegisterController extends BaseController
{
    function register($post_data)
    {
        $validity = $this->validateRegistrationForm($post_data);
        // if invalid return with errors
        if(!$validity['is_valid']){
            return ['success'=>$validity['is_valid'],"message"=>$validity['message']];
        }

        // if valid then add the user details.
        $user = [];
        $user['username'] = $post_data['email'];
        $user['PASS'] = $post_data['password'];
        // current date time as default value for these two fields
        $user['datejoined'] = date('Y-m-d H:i:s');
        $user['datelastmodified'] = date('Y-m-d H:i:s');

        // travel user details
        $company = $post_data;
        unset($company['password_confirmation']);
        unset($company['password']);
    
        $user_modal = new User();
        if($user_modal->addUser($user,$company)){
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

    function validateRegistrationForm($post_data){
        $message = [];
        $is_valid = true;
        // required validation
        $result =  Validators::required([
            'Company Name' => $post_data['company_name'],
            'Address' => $post_data['address'],
            'City' => $post_data['city'],
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

        return ['is_valid'=>$is_valid,'message'=>$message];
    }
}
