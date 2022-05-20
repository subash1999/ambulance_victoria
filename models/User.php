<?php
require_once "BaseModel.php";
class User extends BaseModel{
    
    function addUser($user,$company){
        var_dump($user);
        var_dump($company);
        // query1 to add to company
        $query1 = $this->insertQuery('company',$company);
        // query2 to select the id
        $query2 = $this->selectQuery('company',"*","WHERE email='".$company['email']."'");
        
        $conn = $this->connect();
        /* set autocommit to off for trasaction*/
        $conn->autocommit(FALSE);
        // query
        $conn->query($query1);
        $result = $conn->query($query2);
        $company_id = null;
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $company_id = $row['id'];
        }
        $user['company_id'] = $company_id;
        // query to add to user
        $query3 = $this->insertQuery('user',$user);

        $conn->query($query3);
        // commit
        $is_comitted = $conn->commit();
        $conn->autocommit(TRUE);
        $conn->close();
        // return true if comitted successfully
        return $is_comitted;
    }

   
    
}