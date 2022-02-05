<?php 
// Get the contents of the env JSON file 
define("ENV_JSON", file_get_contents("../env.json"));
define("ENV", json_decode(ENV_JSON, true));