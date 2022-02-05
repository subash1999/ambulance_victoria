<?php
require_once "BaseController.php";
require_once "../models/User.php";
require_once "../models/TravelImage.php";
require_once "../models/Post.php";

class UserController extends BaseController{
    function getAllUsers(){
        $user = new User();
        $users = [];
        $result = $user->getAllUsers();
        while($row = $result->fetch_assoc()){
            array_push($users,$row);
        }
        
        return $users;
    }
    function getUser($user_id){
        $user = new User();
        $result = $user->getUser($user_id);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    function getPostsByUser($user_id){
        $post = new Post();
       return $this->fetchAllResults($post->getPostsByUser($user_id));
    }

    function getTravelImagesByUser($user_id){
        $image = new TravelImage();
        return $this->fetchAllResults($image->getTravelImagesByUser($user_id));
    }

    function getNewAdditions()
    {
        $travel_image = new TravelImage();
        return $travel_image->getNewImages();
    }
}