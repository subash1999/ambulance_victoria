<?php
require_once "BaseModel.php";
class Company extends BaseModel
{
    function getCompanyDetails($company_id){
        return $this->executeQuery(
            $this->selectQuery('company',"*",' WHERE id='. $company_id)
        );
    }

    function getCompanyVehiclesList($companye_id){
        return $this->executeQuery(
            $this->selectQuery('vehicle',"*"," WHERE company_id=".$companye_id)
        );
    }

    function getCompaniesList(){
        return $this->executeQuery(
            $this->selectQuery('company',"*"," ORDER BY company_name")
        );
    }
}