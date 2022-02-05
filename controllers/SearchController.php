<?php
require_once "BaseController.php";
require_once "../models/City.php";
require_once "../models/Country.php";
require_once "../models/TravelImage.php";

class SearchController extends BaseController
{

    function getSearchParams($get_params)
    {
        $image_title = null;
        $cities = null;
        $countries = null;
        $page = 1;
        $page_size = ENV["default_search_page_size"];
        if (isset($get_params['image_title'])) {
            $image_title = isset($get_params['image_title']);
        }
        if (isset($get_params['cities'])) {
            $cities = isset($get_params['cities']);
        }
        if (isset($get_params['countries'])) {
            $countries = isset($get_params['countries']);
        }
        if (isset($get_params['page'])) {
            $page = isset($get_params['page']);
        }
        if (isset($get_params['page_size'])) {
            $page_size = isset($get_params['page_size']);
        }
        return  [
            'image_title'=>$image_title,
            'cities'=>$cities,
            'countries'=>$countries,
            'page'=>$page,
            'page_size'=>$page_size,
        ];
    }
    function getSearchResults($search_params)
    {
    }
}
