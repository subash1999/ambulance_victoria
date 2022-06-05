<?php
require_once 'BaseController.php';
require_once '../utils/Auth.php';
require_once '../models/Vehicle.php';
require_once '../models/Company.php';

class CompanyController extends BaseController
{
    function getCompanyDetails($Company_id){
        return $this->fetchResultFirstOrFail(
            (new Company())->getCompanyDetails($Company_id)
        );
    }

    function getCompanyVehiclesList($company_id){
    
        return $this->fetchAllResults(
            (new Company())->getCompanyVehiclesList($company_id)
        );
    }

    function getCompaniesList(){
        return $this->fetchAllResults(
            (new Company())->getCompaniesList()
        );
    }
}
