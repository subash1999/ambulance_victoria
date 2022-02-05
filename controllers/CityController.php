<?php
require_once "BaseController.php";
require_once "../models/City.php";
require_once "../models/Country.php";
require_once "../models/TravelImage.php";

class CityController extends BaseController{
    /**
     * Params
     * $geo_name_id: ISO of the country
     */
    function getCityDetails($geo_name_id){
        return $this->fetchResultFirstOrFail(
            (new City())->getCityByGeoNameId($geo_name_id)
        );
    }

    function getCountryDetails($iso){
        return $this->fetchResultFirstOrFail(
            (new Country())->getCountryByISO($iso)
        );
    }

    function getTravelImagesOfCity($geo_name_id){        
        return $this->fetchAllResults(
            (new TravelImage())->getTravelImagesOfCity($geo_name_id)
        );
    }
}