<?php
require_once "BaseModel.php";
class Vehicle extends BaseModel
{
    function getVehicleDetails($vehicle_id){
        return $this->executeQuery(
            $this->selectQuery('vehicle',"*",' WHERE id='.$vehicle_id)
        );
    }

    function getVehiclesListOfCompany($companye_id){
        return $this->executeQuery(
            $this->selectQuery('vehicle',"*"," WHERE company_id=".$companye_id)
        );
    }

    function getVehiclesList(){
        return $this->executeQuery(
            $this->selectQuery('vehicle',"*"," ORDER BY license_plate")
        );
    }
}