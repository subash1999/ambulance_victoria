<?php
require_once '../models/User.php';

class Validators{
    static function required($values){
        $msg = [];
        $is_valid = true;
        foreach($values as $key => $value ){
            if($value == '' || $value == null){
                $is_valid = $is_valid && false;
                $msg[$key] = "$key is required.";
            }
        }
        if(!$is_valid){
            return ["is_valid" => $is_valid, "message"=>$msg ];
        }
        
        return ["is_valid" => $is_valid, "message"=>"Valid" ];
    }

    static function userEmailUnique($email){
        $user = new User();
        $user = $user->executeQuery($user->selectQuery('user',"*","WHERE username= '$email'"));
        if($user->num_rows > 0){
            return ["is_valid" => false, "message"=>["Email '$email' already exists."] ];
        }
        return ["is_valid" => true, "message"=>"Valid" ];

    }

    static function twoFieldsMatch($fieldValueArray1, $fieldValueArray2){
        $key1 = "";
        $value1 = "";
        $key2 = "";
        $value2 = "";
        foreach($fieldValueArray1 as $key => $value){
            $key1 = $key;
            $value1 = $value;
        }
        foreach($fieldValueArray2 as $key => $value){
            $key2 = $key;
            $value2 = $value;
        }

        if($value1 == $value2){
            return ["is_valid" => true, "message"=>"Valid" ];
        }
        else{
            return ["is_valid" => false, "message"=>["$key2 does not match with $key1."] ];
        }
        
    }
}