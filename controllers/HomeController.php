<?php
require_once  '../models/TravelImage.php';

class HomeController
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
}
