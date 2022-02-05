<?php
require_once "BaseModel.php";
class Country extends BaseModel{
    
    function getCountryByISO($iso){
        return $this->executeQuery($this->selectQuery("geocountries","*","WHERE ISO='$iso'"));

    }

    
}