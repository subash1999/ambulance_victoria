<?php
require_once "BaseModel.php";
class User extends BaseModel{
    
    function addUser($traveluser,$traveluserdetails){
        // query to add to traveluser
        $query1 = $this->insertQuery('traveluser',$traveluser);
        // query3 to select the UID
        $query2 = $this->selectQuery('traveluser',"*","WHERE username='".$traveluser['username']."'");
        
        $conn = $this->connect();
        /* set autocommit to off for trasaction*/
        $conn->autocommit(FALSE);
        // query
        $conn->query($query1);
        $result = $conn->query($query2);
        $uid = null;
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $uid = $row['UID'];
        }
        $traveluserdetails['UID'] = $uid;
        // query to add to traveluserdetails
        $query3 = $this->insertQuery('traveluserdetails',$traveluserdetails);

        $conn->query($query3);
        // commit
        $is_comitted = $conn->commit();
        $conn->autocommit(TRUE);
        $conn->close();
        // return true if comitted successfully
        return $is_comitted;
    }

    function getAllUsers(){
        $query = "
        SELECT
            *
        FROM
            traveluser
        INNER JOIN traveluserdetails ON traveluserdetails.UID = traveluser.UID
        LEFT OUTER JOIN geocountries ON traveluserdetails.Country = geocountries.CountryName      
        LEFT OUTER JOIN geocities ON traveluserdetails.City = geocities.AsciiName
        GROUP BY traveluser.UID;
        ";
        return $this->executeQuery($query);
    }

    function getUsersFollowers($user_id){
        $query = "
        SELECT
            *
        FROM
            traveluser
        LEFT JOIN traveluserfollowing ON traveluserfollowing.UID = traveluser.UID
        WHERE
            traveluser.UID = $user_id;
        ";
        return $this->executeQuery($query);
    }

    function getUsersFollowing($user_id){
        $query = "
        SELECT
            *
        FROM
            traveluser
        LEFT JOIN traveluserfollowing ON traveluserfollowing.UIDFollowing = traveluser.UID
        WHERE
            traveluser.UID = $user_id;
        ";
        return $this->executeQuery($query);
    }

    function getPostsByUser($user_id){
        $query = "
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
        WHERE travelpost.UID = $user_id;
        ";
        return $this->executeQuery($query);
    }

    function getTravelImageByUser($user_id){
        $query =
            "
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
        HAVING uid = $user_id
        ORDER BY
            avg_rating
        ;
        
        ";
        return $this->executeQuery($query);
    }
    
}