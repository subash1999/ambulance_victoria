<?php
require_once "BaseController.php";
require_once "../models/Country.php";
require_once "../models/TravelImage.php";

class CountryController extends BaseController{
    /**
     * Params
     * $iso: ISO of the country
     */
    function getCountryDetails($iso){
        return $this->fetchResultFirstOrFail(
            (new Country())->getCountryByISO($iso)
        );
    }

    
    function getTravelImagesOfCountry($iso){

        return $this->fetchAllResults(
            (new TravelImage())->getTravelImagesOfCountry($iso)
        );
    }
}