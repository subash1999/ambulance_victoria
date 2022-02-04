<?php
require_once 'BaseController.php';
require_once  '../models/TravelImage.php';
require_once '../models/Post.php';

class HomeController extends BaseController
{
    function getTravelPhotosTreeViewMenu()
    {
        $continents = [];
        $travel_image = new TravelImage();
        $result = $travel_image->travelImageCategorized();
        while($row = $result->fetch_assoc()){
            array_push($continents, $row);
        }
        return $continents;
    }

    function getTopImages()
    {
        $travel_image = new TravelImage();
        return $travel_image->topImages();
    }

    function getNewAdditions()
    {
        $travel_image = new TravelImage();
        return $travel_image->newImages();
    }

    function getRecentPosts(){
        $post = new Post();
        return $this->fetchAllResults($post->getRecentPosts());
    }
}
