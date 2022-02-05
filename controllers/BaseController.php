<?php
require_once "../models/TravelImage.php";
require_once "../models/Post.php";

class BaseController
{

    function fetchAllResults($result)
    {
        $res = [];
        while ($row = $result->fetch_assoc()) {
            array_push($res, $row);
        }
        return $res;
    }

    function fetchFirstResult($result)
    {
        
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    function fetchResultFirstOrFail($result)
    {
        if($result->num_rows <=0 ){
            Redirect::notFound();
        }
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    function getTopImages()
    {
        return $this->fetchAllResults(
            (new TravelImage())->getTopImages()
        );
    }

    function getNewAdditions()
    {
        return $this->fetchAllResults(
            (new TravelImage())->getNewImages()
        );
    }

    function getRecentPosts()
    {
        return $this->fetchAllResults((new Post())->getRecentPosts());
    }
}
