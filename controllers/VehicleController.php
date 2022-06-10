<?php
require_once 'BaseController.php';
require_once '../utils/Auth.php';
require_once '../models/Vehicle.php';

class VehicleController extends BaseController
{
    function search($address,$landmark,$search_nearby){
        $vehicle = new Vehicle();
        if($search_nearby!=null){
            
            return $this->fetchAllResults(($vehicle->executeQuery($vehicle->selectQuery('vehicle'))));
        }
        else{
            $where = "";
            if($address != null && $address != ""){
                $where .= " full_address LIKE '%".$address."%'";
            }
            if($landmark != null && $landmark != ""){
                if($where != ""){
                    $where .= " OR ";
                }
                $where .= " landmark LIKE '%".$landmark."%'";
            }
            $where = $where != "" ? " WHERE ".$where:"";
            $query  = $vehicle->selectQuery('vehicle',"*",$where);
            // echo($query);
            return $this->fetchAllResults($vehicle->executeQuery($query));
        }
    }
    function create($post_data)
    {
        $license_plate = $post_data['license_plate'];
        $vehicle_model = $post_data['vehicle_model'];
        $driver_name = $post_data['driver_name'];
        $phone_number = $post_data['phone_number'];
        $full_address = $post_data['full_address'];
        $landmark = $post_data['landmark'];
        $latitude = $post_data['latitude'];
        $longitude = $post_data['longitude'];
        $message = [];
        $result =  Validators::required([
            'License Plate' => $license_plate,
            'Vehicle Model' => $vehicle_model,
            'Driver Name' => $driver_name,
            'Phone Number' => $phone_number,
            'Full Address' => $full_address,
            'Landmark' => $landmark,
            'Latitude' => $latitude,
            'Longitude' => $longitude
        ]);
        if (!$result['is_valid']) {
            return ['success' => false, 'message' => $result['message']];
        }
        $vehicle = new Vehicle();
        $query = $vehicle->insertQuery('vehicle', [
            'license_plate' => $license_plate,
            'vehicle_model' => $vehicle_model,
            'driver_name' => $driver_name,
            'phone_number' => $phone_number,
            'full_address' => $full_address,
            'landmark' => $landmark,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'company_id' => Auth::currentCompany()['id']
        ]);
        $return_val = $vehicle->executeQueryGetResultAndInsertId($query);
        if ($return_val['result']) {
            Alert::setAlertMessage("Vehicle added successfully.", "Vehicle Creation Success");

            echo '<script>

            window.location="/views/vehicle.php?id='.$return_val['insert_id'].'";

            </script>';
        } else {
            array_push($message, "Failed to add new vehicle.");
        }
        return ["success" => false, "message" => $message];
    }

    function update($post_data)
    {   
        $id = $post_data['id'];
        $license_plate = $post_data['license_plate'];
        $vehicle_model = $post_data['vehicle_model'];
        $driver_name = $post_data['driver_name'];
        $phone_number = $post_data['phone_number'];
        $full_address = $post_data['full_address'];
        $landmark = $post_data['landmark'];
        $latitude = $post_data['latitude'];
        $longitude = $post_data['longitude'];
        $message = [];
        $result =  Validators::required([
            'Vehicle ID' => $id,
            'License Plate' => $license_plate,
            'Vehicle Model' => $vehicle_model,
            'Driver Name' => $driver_name,
            'Phone Number' => $phone_number,
            'Full Address' => $full_address,
            'Landmark' => $landmark,
            'Latitude' => $latitude,
            'Longitude' => $longitude
        ]);
        if (!$result['is_valid']) {
            return ['success' => false, 'message' => $result['message']];
        }
        $vehicle = new Vehicle();
        $query = $vehicle->updateQuery('vehicle', [
            'license_plate' => $license_plate,
            'vehicle_model' => $vehicle_model,
            'driver_name' => $driver_name,
            'phone_number' => $phone_number,
            'full_address' => $full_address,
            'landmark' => $landmark,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'company_id' => Auth::currentCompany()['id']
        ],' WHERE id='.$id);
        $result = $vehicle->executeQuery($query);
        if ($result) {
            Alert::setAlertMessage("Vehicle:".$license_plate." updated successfully.", "Vehicle update Success");

            echo '<script>

            window.location="/views/vehicle.php?id='.$id.'";

            </script>';
        } else {
            array_push($message, "Failed to update vehicle:".$license_plate.".");
        }
        return ["success" => false, "message" => $message];
    }

    function delete($vehicle_id){
        $vehicle = new Vehicle();
        $query = $vehicle->deleteQuery('vehicle',' WHERE id='.$vehicle_id);
        $result = $vehicle->executeQuery($query);
        if($result){
            Alert::setAlertMessage("Vehicle deleted successfully.", "Vehicle Deletion Success");
            echo '<script>

            window.location="/views/my_vehicles.php";

            </script>';
        }
        else {
            array_push($message, "Failed to delete vehicle");
        }
        return ["success" => false, "message" => $message];
    }

    function getVehicleDetails($vehicle_id)
    {
        return $this->fetchResultFirstOrFail(
            (new Vehicle())->getVehicleDetails($vehicle_id)
        );
    }

    function getMyVehiclesList()
    {
        $row = $this->fetchFirstResult(
            (new User())->getCompanyOfUser(Auth::currentUser()['id'])
        );

        if ($row == null) {
            return [];
        }
        return $this->fetchAllResults(
            (new Vehicle())->getVehiclesListOfCompany($row['id'])
        );
    }

    function getVehiclesList()
    {
        return $this->fetchAllResults(
            (new Vehicle())->getVehiclesList()
        );
    }
}
