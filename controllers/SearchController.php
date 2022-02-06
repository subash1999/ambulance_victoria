<?php
require_once "BaseController.php";
require_once "../models/City.php";
require_once "../models/Country.php";
require_once "../models/TravelImage.php";

class SearchController extends BaseController
{

    function getSearchResults($search_params)
    {
        $results = $this->fetchAllResults(
            (new TravelImage())->searchTravelImage($search_params['image_title'],$search_params['countries'],$search_params['cities'])
        );
        $count = $this->fetchFirstResult(
            (new TravelImage())->searchTravelImageTotalCount($search_params['image_title'],$search_params['countries'],$search_params['cities'])
        )['count'];
        $countries = $this->fetchAllResults(
            (new TravelImage())->getUniquesCountriesInSearch()
        );
        $cities = $this->fetchAllResults(
            (new TravelImage())->getUniquesCitiesInSearch()
        );
        return ['results'=>$results,'count'=>$count,'countries'=>$countries,'cities'=>$cities];
        
    }

    function getSearchParams($get_params)
    {
        $image_title = null;
        $cities = [];
        $countries = [];
        $page = 1;
        $page_size = ENV["default_search_page_size"];
        if (isset($get_params['image_title'])) {
            $image_title = $get_params['image_title'];
        }
        if (isset($get_params['cities'])) {
            $cities = $get_params['cities'];
        }
        if (isset($get_params['countries'])) {
            $countries = $get_params['countries'];
        }
        if (isset($get_params['page'])) {
            $page = $get_params['page'];
        }
        if (isset($get_params['page_size'])) {
            $page_size = $get_params['page_size'];
        }
        return  [
            'image_title'=>$image_title,
            'cities'=>$cities,
            'countries'=>$countries,
            'page'=>$page,
            'page_size'=>$page_size,
        ];
    }
    
}
