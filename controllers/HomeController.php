<?php
require_once 'BaseController.php';
require_once  '../models/TravelImage.php';
require_once '../models/Post.php';

class HomeController extends BaseController
{
    function getTravelPhotosTreeViewMenu()
    {
        return $this->fetchAllResults(
            (new TravelImage())->travelImageCategorized()
        );
       
    }

    function getTopImages()
    {
        return $this->fetchAllResults(
            (new TravelImage())->getTopImages()
        );
    }

    function getNewAdditions()
    {
        return $this->fetchAllResults(
            (new TravelImage())->getNewImages()
        );
    }

    function getRecentPosts(){
        return $this->fetchAllResults((new Post())->getRecentPosts());
    }
}
