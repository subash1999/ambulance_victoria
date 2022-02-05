<?php
require_once "BaseModel.php";
class City extends BaseModel
{
    function getCityByGeoNameId($geo_name_id)
    {
        return $this->executeQuery($this->selectQuery("geocities", "*", "WHERE GeoNameID=$geo_name_id"));
    }
}
