<?php
require_once "BaseModel.php";
class Post extends BaseModel{

    function getAllPosts(){
        $query = 
        "
        SELECT
            *
        FROM
            travelpost
        INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID
        INNER JOIN travelimage ON travelpostimages.ImageID = travelimage.ImageID
        INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID
        INNER JOIN traveluser ON travelpost.UID = traveluser.UID
        INNER JOIN traveluserdetails ON travelpost.UID = traveluserdetails.UID
        GROUP BY
            travelpost.PostID;
        ";
        return $this->executeQuery($query);
    }

    function getPost($post_id){
        $query = 
        "
        SELECT
            *
        FROM
            travelpost
        INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID
        INNER JOIN travelimage ON travelpostimages.ImageID = travelimage.ImageID
        INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID
        INNER JOIN traveluser ON travelpost.UID = traveluser.UID
        INNER JOIN traveluserdetails ON travelpost.UID = traveluserdetails.UID
        GROUP BY
            travelpost.PostID
        HAVING travelpost.PostID = $post_id;
        ";
        return $this->executeQuery($query);
    }

    function getRecentPosts($limit =3 ){
        $query = 
        "
        SELECT
            *
        FROM
            travelpost
        INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID
        INNER JOIN travelimage ON travelpostimages.ImageID = travelimage.ImageID
        INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID
        INNER JOIN traveluser ON travelpost.UID = traveluser.UID
        INNER JOIN traveluserdetails ON travelpost.UID = traveluserdetails.UID
        GROUP BY
            travelpost.PostID
        ORDER BY 
            travelpost.PostTime
        DESC
        LIMIT $limit;
        ";
        return $this->executeQuery($query);
    }

    function getPostByUser($user_id){
        $query = 
        "
        SELECT
            *
        FROM
            travelpost
        INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID
        INNER JOIN travelimage ON travelpostimages.ImageID = travelimage.ImageID
        INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID
        INNER JOIN traveluser ON travelpost.UID = traveluser.UID
        INNER JOIN traveluserdetails ON travelpost.UID = traveluserdetails.UID
        GROUP BY
            travelpost.PostID
        HAVING travelpost.UID = $user_id;
        ";
        return $this->executeQuery($query);
    }



    function getImagesOfPost($post_id){
        $query="
        SELECT
            travelimage.ImageID AS image_id,
            travelimage.path AS image_path,
            travelimagedetails.Title AS title,
            geocountries.ISO AS country_iso,
            geocontinents.ContinentName AS continent_name,
            geocountries.CountryName AS country_name,
            geocities.GeoNameID AS geo_name_id,
            geocities.AsciiName AS city_name,
            travelimagedetails.Description AS description,
            travelimagelocations.ImageLocationID AS image_location_id,
            travelimagelocations.LocationName AS location_name,
            traveluserdetails.UID AS uid,
            traveluserdetails.FirstName AS first_name,
            traveluserdetails.LastName AS last_name,
            travelpost.PostID AS post_id,
            travelpost.Title AS post_title,
            ROUND(
                AVG(travelimagerating.Rating),
                2
            ) AS avg_rating
        FROM
            travelimage
        LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
        LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
        LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
        LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
        LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
        LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
        LEFT JOIN geocontinents ON geocountries.Continent = geocontinents.ContinentCode
        LEFT JOIN travelpostimages ON travelpostimages.ImageID = travelimage.ImageID
        LEFT JOIN travelpost ON travelpost.PostID = travelpostimages.PostID
        GROUP BY
            image_id
        HAVING
            post_id = $post_id
        ORDER BY
            avg_rating;
        ";
        return $this->executeQuery($query);

    }

    
    
}