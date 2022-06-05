<?php
require_once 'BaseController.php';
require_once '../utils/Auth.php';
require_once '../models/Vehicle.php';

class VehicleController extends BaseController
{
    function getVehicleDetails($vehicle_id){
        return $this->fetchResultFirstOrFail(
            (new Vehicle())->getVehicleDetails($vehicle_id)
        );
    }

    function getMyVehiclesList(){
        $row = $this->fetchFirstResult(
            (new User())->getCompanyOfUser(Auth::currentUser()['id'])
        );
        
        if($row == null){
            return [];
        }
        return $this->fetchAllResults(
            (new Vehicle())->getVehiclesListOfCompany($row['id'])
        );
    }

    function getVehiclesList(){
        return $this->fetchAllResults(
            (new Vehicle())->getVehiclesList()
        );
    }
}
