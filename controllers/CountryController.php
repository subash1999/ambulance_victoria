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
        return $this->fetchFirstResult(
            (new Country())->getCountryByISO($iso)
        );
    }

    function getTravelImageOfCountry($iso){

    }
}