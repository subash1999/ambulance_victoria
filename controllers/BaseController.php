<?php 

class BaseController{

    function fetchAllResults($result){
        $res = [];
        while($row = $result->fetch_assoc()){
            array_push($res,$row);
        }
        return $res;

    }
    
}