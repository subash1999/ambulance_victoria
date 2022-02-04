<?php
class Date{
    static function shortDate($timestamp){
        return date("F jS, Y", strtotime($timestamp));
    }
}