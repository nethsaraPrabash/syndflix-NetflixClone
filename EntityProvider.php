<?php

class EntityProvider{

    public static function getEntities($con, $categoryID, $limit) {
        $sql = "SELECT * FROM entities ";

        if($categoryID != null) {
            $sql .= "WHERE categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query = $con->prepare($sql);

        if($categoryID != null) {
            $query->bindValue(":categoryId", $categoryID);
        
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->execute();

        $result = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Entity($con, $row);
        }

        return $result;

}
}
?>