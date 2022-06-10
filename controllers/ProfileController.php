<?php
require_once 'BaseController.php';
require_once '../utils/Auth.php';
require_once '../models/Company.php';

class ProfileController extends BaseController
{
    function getCompanyDetails()
    {
        $current_user = Auth::currentUser();
        return Auth::currentCompany();
    }
    function changePassword($post_data)
    {
        $message = [];
        $is_valid = true;
        // required validation
        $result =  Validators::required([
            'Current Password' => $post_data['current_password'],
            'Password' => $post_data['password'],
            'Confirm New Password' => $post_data['password_confirmation'],
        ]);
        if (!$result['is_valid']) {
            $is_valid = $is_valid && $result['is_valid'];
            $message = array_merge($message, $result['message']);
        }
        $user = new User();
        $result = $this->fetchAllResults(
            $user->executeQuery(
                $user->selectQuery('user', "*", " WHERE id=" . Auth::currentUser()['id'] . " AND PASS='" . $_POST['current_password'] . "'")
            )
        );
        if(count($result)==0){
            $is_valid = $is_valid && false;
            $message = array_merge($message, ["Current Password is incorrect."]);
        }

        // password validation
        $result = Validators::twoFieldsMatch(
            ['Password' => $post_data['password']],
            ['Password Confirmation' => $post_data['password_confirmation']]
        );
        if (!$result['is_valid']) {
            $is_valid = $is_valid && $result['is_valid'];
            $message = array_merge($message, $result['message']);
        }      

        // if invalid return with errors
        if (!$is_valid) {
            return ['success' => $is_valid, "message" => $message];
        }

        $result = $user->executeQuery(
            $user->updateQuery('user',['PASS'=>$_POST['password']]," WHERE id=".Auth::currentUser()['id'])
        );
        if ($result) {
            Alert::setAlertMessage("Password Changed Successfully.", "Password Change Success");

            echo '<script>

            window.location="/views/profile.php";

            </script>';
        } else {
            array_push($message, "Failed to change password.");
        }
        return ["success" => false, "message" => $message];
    }
    function update($post_data)
    {
        $company_name = $post_data['company_name'];
        $address = $post_data['address'];
        $city = $post_data['city'];
        $region = $post_data['region'];
        $postal = $post_data['postal'];
        $phone = $post_data['phone'];
        $message = [];
        $result =  Validators::required([
            'Company Name' => $company_name,
            'Address' => $address,
            'City' => $city,
            'Region' => $region,
            'Postal' => $postal,
            'Phone' => $phone,
        ]);
        if (!$result['is_valid']) {
            return ['success' => false, 'message' => $result['message']];
        }
        $company = new Company();
        $query = $company->updateQuery('company', [
            'company_name' => $company_name,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'postal' => $postal,
            'phone' => $phone,
        ], ' WHERE id = ' . Auth::currentCompany()['id']);
        $result = $company->executeQuery($query);
        if ($result) {
            Alert::setAlertMessage("Profile updated successfully.", "Profile Update Success");

            echo '<script>

            window.location="/views/profile.php";

            </script>';
        } else {
            array_push($message, "Failed to update data.");
        }
        return ["success" => false, "message" => $message];
    }
}
