<?php
class Redirect{
    static function notFound(){
        echo "<script>window.location=\"/views/404.php\"</script>";
    }
}