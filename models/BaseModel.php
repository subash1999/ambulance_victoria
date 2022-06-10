
<?php
class BaseModel
{
    function connect()
    {
        $servername = ENV['servername'];
        $database = ENV['database'];
        $username = ENV['username'];
        $password = ENV['password'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function executeQuery($query)
    {
        $conn = $this->connect();
        $result =  $conn->query($query);
        $conn->close();
        return $result;
    }

    public function executeQueryGetResultAndInsertId($query)
    {
        $conn = $this->connect();
        $result =  $conn->query($query);
        $insert_id = $conn->insert_id;
        $conn->close();
        return ['result'=>$result,'insert_id'=>$insert_id];
    }

    public function selectQuery($table_name, $columns = "*", $where_condition = "")
    {
        return "SELECT  $columns FROM $table_name $where_condition";
    }

    public function insertQuery($table_name, $column_value_array = null)
    {
        $columns = "";
        $values = "";
        if ($column_value_array != null) {
            $columns = array_keys($column_value_array);
            $columns = "(" . join(",", $columns) . ")";

            $values = [];
            $temp_values = array_values($column_value_array);
            foreach ($temp_values as $value) {
                if (gettype($value) == gettype("string")) {
                    array_push($values, "'" . $value . "'");
                }
                else{
                    array_push($values,$value);
                }
            }
            $values = "(" . join(",", $values) . ")";
        }
        return "INSERT INTO $table_name $columns VALUES $values";
    }

    public function updateQuery($table_name, $column_value_array, $where = null)
    {
        $update_query = "";
        if ($column_value_array != null) {
            $update_query = [];
            foreach ($column_value_array as $key => $value) {
                if(gettype($value) == gettype("string")){
                    array_push($update_query, "$key='$value'");
                }
                else{
                    array_push($update_query, "$key=$value");
                }
                
            }
            $update_query = join(", ", $update_query);
            // $update_query = "";
        }
        return "UPDATE $table_name SET $update_query $where";
    }

    public function deleteQuery($table, $where = null)
    {
        return "DELETE FROM $table $where";
    }
}
