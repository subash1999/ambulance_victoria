<?php
require_once 'BaseController.php';
require_once '../utils/Auth.php';


class ProfileController extends BaseController
{
    function getCompanyDetails(){
        $current_user = Auth::currentUser();
        return Auth::currentCompany();
    }
}
