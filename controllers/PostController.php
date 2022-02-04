<?php
require_once "BaseController.php";
require_once "../models/Post.php";

class PostController extends BaseController{
    function getAllPosts(){
        $post = new Post();
        $posts = [];
        $result = $post->getAllPosts();
        while($row = $result->fetch_assoc()){
            array_push($posts,$row);
        }
        
        return $posts;
    }
    function getPost($post_id){
        $post = new Post();
        $result = $post->getPost($post_id);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    function getImagesOfPost($post_id){
        $post = new Post();
        $images = [];
        $result = $post->getImagesOfPost($post_id);
        while($row = $result->fetch_assoc()){
            array_push($images,$row);
        }
        return $images;
    }

    function getOtherPostsByUser($user_id,$current_post_id){
        $post = new Post();
        $posts = [];
        $result = $post->getPostByUser($user_id,$current_post_id);
        while($row = $result->fetch_assoc()){
            if($row['UID']!=$current_post_id){
                array_push($posts,$row);
            }
            
        }
        return $posts;
    }

    function getTopImages()
    {
        $travel_image = new TravelImage();
        return $travel_image->topImages();
    }

    function getRecentPosts(){
        $post = new Post();
        return $this->fetchAllResults($post->getRecentPosts());
    }
}