<?php
require_once "BaseModel.php";
class TravelImage extends BaseModel
{
    function getAllRatingsOfImage($image_id)
    {
        return
            $this->executeQuery($this->selectQuery('travelimagerating', "*", "WHERE imageID=$image_id"));
    }

    function addRating($image_id, $rating)
    {
        return
            $this->executeQuery($this->insertQuery('travelimagerating', ['ImageID' => $image_id, "Rating" => $rating]));
    }

    function deleteRating($image_rating_id)
    {
        return
            $this->executeQuery($this->deleteQuery('travelimagerating', " WHERE ImageRatingID=$image_rating_id"));
    }
    function getTravelImagesByUser($user_id)
    {
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
    function getTravelImageDetails($image_id)
    {
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
            travelimagedetails.Longitude as Longitude,
            travelimagedetails.Latitude as Latitude,
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
        HAVING image_id = $image_id
        ORDER BY
            avg_rating
        ;
        
        ";
        return $this->executeQuery($query);
    }
    function getRelatedTravelImages($image_id, $limit = 3)
    {
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
        HAVING image_id != $image_id
        ORDER BY
            rand()
        LIMIT $limit
        ;
    
        ";
        return $this->executeQuery($query);
    }
    function getTopImages($limit = 3)
    {
        $query = "
            SELECT
                travelimage.ImageID as image_id,
                travelimage.path as image_path,
                travelimagedetails.Title as title,
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name,
                geocities.AsciiName as city_name,
                geocities.GeoNameId as geo_name_id,
                travelimagedetails.Description as description,
                travelimagelocations.ImageLocationID as image_location_id,
                travelimagelocations.LocationName as location_name,
                traveluserdetails.UID as uid,
                traveluserdetails.FirstName as first_name,
                traveluserdetails.LastName as last_name,
                ROUND(AVG(travelimagerating.Rating),2) AS avg_rating
            FROM
                travelimage
            INNER JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            INNER JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            INNER JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            GROUP BY
                travelimagerating.ImageID
            ORDER BY
                avg_rating
            DESC 
            LIMIT $limit;
        ";
        return $this->executeQuery($query);
    }

    function getNewImages($limit = 3)
    {
        $query = "
            SELECT
                travelimage.ImageID as image_id,
                travelimage.path as image_path,
                travelimagedetails.Title as title,
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name,
                geocities.AsciiName as city_name,
                geocities.GeoNameId as geo_name_id,
                travelimagedetails.Description as description,
                travelimagelocations.ImageLocationID as image_location_id,
                travelimagelocations.LocationName as location_name,
                traveluserdetails.UID as uid,
                traveluserdetails.FirstName as first_name,
                traveluserdetails.LastName as last_name,
                ROUND(AVG(travelimagerating.Rating),2) AS avg_rating
            FROM
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            GROUP BY
                image_id
            ORDER BY
                image_id
            DESC 
            LIMIT $limit;
        ";
        return $this->executeQuery($query);
    }

    function getTravelImagesOfCountry($country_iso, $limit = null)
    {
        $query = "
            SELECT
                travelimage.ImageID as image_id,
                travelimage.path as image_path,
                travelimagedetails.Title as title,
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name,
                geocities.AsciiName as city_name,
                geocities.GeoNameId as geo_name_id,
                travelimagedetails.Description as description,
                travelimagelocations.ImageLocationID as image_location_id,
                travelimagelocations.LocationName as location_name,
                traveluserdetails.UID as uid,
                traveluserdetails.FirstName as first_name,
                traveluserdetails.LastName as last_name,
                ROUND(AVG(travelimagerating.Rating),2) AS avg_rating
            FROM
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            GROUP BY
                image_id
            HAVING 
                country_iso='$country_iso'
            ORDER BY
                avg_rating
            DESC 
        ";
        if ($limit) {
            $query .= " LIMIT $limit";
        }
        $query .= ";";
        return $this->executeQuery($query);
    }

    function getTravelImagesOfCity($geo_name_id, $limit = null)
    {
        $query = "
            SELECT
                travelimage.ImageID as image_id,
                travelimage.path as image_path,
                travelimagedetails.Title as title,
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name,
                geocities.AsciiName as city_name,
                geocities.GeoNameId as geo_name_id,
                travelimagedetails.Description as description,
                travelimagelocations.ImageLocationID as image_location_id,
                travelimagelocations.LocationName as location_name,
                traveluserdetails.UID as uid,
                traveluserdetails.FirstName as first_name,
                traveluserdetails.LastName as last_name,
                ROUND(AVG(travelimagerating.Rating),2) AS avg_rating
            FROM
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            GROUP BY
                image_id
            HAVING 
                geo_name_id=$geo_name_id
            ORDER BY
                avg_rating
            DESC 
        ";
        if ($limit) {
            $query .= " LIMIT $limit";
        }
        $query .= ";";
        return $this->executeQuery($query);
    }

    private function travelImageCategorizeQuery()
    {
        $query =
            "
        SELECT
            cities.AsciiName as AsciiName,
            cities.GeoNameId as GeoNameId,
            countries.CountryName as CountryName,
            countries.ISO as ISO,
            continents.ContinentCode as ContinentCode,
            continents.ContinentName as ContinentName
        FROM
            `travelimagedetails` AS detail
        INNER JOIN geocities AS cities
        ON
            detail.CityCode = cities.GeoNameID
        INNER JOIN geocountries AS countries
        ON
            detail.CountryCodeISO = countries.ISO
        INNER JOIN geocontinents AS continents
        ON
            countries.Continent = continents.ContinentCode        
        ";
        return $query;
    }
    function travelImageCategorized()
    {
        $query = $this->travelImageCategorizeQuery();
        $query .= " GROUP BY ContinentName, CountryName, AsciiName;";
        return $this->executeQuery($this->travelImageCategorizeQuery());
    }
    function travelImageByContinent()
    {
        $query = $this->travelImageCategorizeQuery();
        $query .= " GROUP BY ContinentName;";
        return $this->executeQuery($query);
    }

    function travelImageByCountryOfContinent($continent)
    {
        $query = $this->travelImageCategorizeQuery();
        $query .= " GROUP BY CountryName HAVING CountryName='$continent';";
        return $this->executeQuery($query);
    }

    function travelImageByCityOfCountry($continent)
    {
        $query = $this->travelImageCategorizeQuery();
        $query .= " GROUP BY CountryName HAVING ContinentName='$continent';";
        return $this->executeQuery($query);
    }

    private function searchTravelImageQuery($having_condition = "")
    {
        $query = "
            SELECT
                travelimage.ImageID as image_id,
                travelimage.path as image_path,
                travelimagedetails.Title as title,
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name,
                geocities.AsciiName as city_name,
                geocities.GeoNameId as geo_name_id,
                travelimagedetails.Description as description,
                travelimagelocations.ImageLocationID as image_location_id,
                travelimagelocations.LocationName as location_name,
                traveluserdetails.UID as uid,
                traveluserdetails.FirstName as first_name,
                traveluserdetails.LastName as last_name,
                ROUND(AVG(travelimagerating.Rating),2) AS avg_rating
            FROM
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            GROUP BY
                image_id
        ";
        $query .=  $having_condition != "" ? " HAVING $having_condition" : "";
        $query .= "
            ORDER BY
                avg_rating
            DESC;
        ";

        return $query;
    }

    function getUniquesCountriesInSearch()
    {
        $query = "
            SELECT DISTINCT
                geocountries.ISO as country_iso,
                geocountries.CountryName as country_name
            FROM 
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            ";
        return $this->executeQuery($query);
    }

    function getUniquesCitiesInSearch()
    {
        $query = "
            SELECT DISTINCT
                geocities.GeoNameId as geo_name_id,
                geocities.AsciiName as city_name
            FROM 
                travelimage
            LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
            LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
            LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
            LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
            LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
            LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
            ";
        return $this->executeQuery($query);
    }

    function filterCondition($image_title = null, $countries = null, $cities = null)
    {
        $filter = "";
        if ($image_title) {
            $filter .= "  travelimagedetails.Title LIKE '%$image_title%'";
        }
        if ($countries) {
            if ($image_title) {
                $filter .= " AND ";
            }

            foreach ($countries as $key => $country) {
                $countries[$key] = " geocountries.ISO = '$country'";
            }

            $filter .= " (" . join(" OR ", $countries) . ")";
        }

        if ($cities) {
            if ($image_title || $countries) {
                $filter .= " AND ";
            }

            foreach ($cities as $key => $city) {
                $cities[$key] = " geocities.GeoNameId = '$city'";
            }

            $filter .= " (" . join(" OR ", $cities) . ")";
        }
        return $filter;
    }
    function searchTravelImage($image_title = null, $countries = null, $cities = null)
    {
        return $this->executeQuery(
            $this->searchTravelImageQuery($this->filterCondition($image_title, $countries, $cities))
        );
    }
    function searchTravelImageTotalCount($image_title = null, $countries = null, $cities = null)
    {

        $query = "
        SELECT 
            COUNT(DISTINCT travelimage.ImageID) as count
        FROM 
            travelimage
        LEFT JOIN travelimagerating ON travelimage.ImageID = travelimagerating.ImageID
        LEFT JOIN travelimagedetails ON travelimagedetails.ImageID = travelimage.ImageID
        LEFT JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
        LEFT JOIN travelimagelocations ON travelimagelocations.ImageID = travelimage.ImageID
        LEFT JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
        LEFT JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
        ";
        $filter = $this->filterCondition($image_title, $countries, $cities);
        if ($filter != "") {
            $query .= " WHERE " . $filter;
        }

        return $this->executeQuery(
            $query
        );
    }
}
