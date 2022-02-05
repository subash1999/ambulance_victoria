<?php
require_once 'BaseController.php';
require_once  '../models/TravelImage.php';
require_once '../models/Post.php';

class HomeController extends BaseController
{
    function getTravelPhotosTreeViewMenu()
    {
        $ret = ['continents'=>[],'countries'=>[],'cities'=>[]];
        $tree_view =  $this->fetchAllResults(
            (new TravelImage())->travelImageCategorized()
        );
        foreach($tree_view as $continent){
            $ret['continents'][$continent['ContinentName']] = $continent;
          }
          foreach($tree_view as $country){
            $ret['countries'][$country['CountryName']] = $country;
          }
          foreach($tree_view as $city){
            $ret['cities'][$city['AsciiName']] = $city;
          }
        return $ret;
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
